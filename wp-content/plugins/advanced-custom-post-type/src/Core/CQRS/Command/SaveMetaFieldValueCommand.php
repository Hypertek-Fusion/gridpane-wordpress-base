<?php

namespace ACPT\Core\CQRS\Command;

use ACPT\Core\Generators\Meta\TableFieldGenerator;
use ACPT\Core\Helper\Strings;
use ACPT\Core\Models\Meta\MetaFieldModel;
use ACPT\Core\Validators\ArgumentsArrayValidator;
use ACPT\Utils\Data\NestedValues;
use ACPT\Utils\Data\Sanitizer;
use ACPT\Utils\PHP\GeoLocation;
use ACPT\Utils\PHP\Url;
use ACPT\Utils\Wordpress\WPAttachment;
use BaconQrCode\Common\ErrorCorrectionLevel;
use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\PngWriter;

class SaveMetaFieldValueCommand extends AbstractMetaFieldValueCommand implements CommandInterface
{
	/**
	 * @inheritDoc
	 * @throws \Exception
	 */
	public function execute()
	{
		$metaFieldModelType = $this->fieldModel->getType();
		$savedFieldType = $this->get($this->fieldModel->getDbName().'_type');
		$value = $this->args['value'];

		if($metaFieldModelType != $savedFieldType){
			if(!$this->set($this->fieldModel->getDbName().'_type', $metaFieldModelType)){
				return false;
			}
		}

		switch ($metaFieldModelType){

            // ADDRESS_TYPE
            case MetaFieldModel::PASSWORD_TYPE:

                $algo = $this->fieldModel->getAdvancedOption("algorithm") ?? PASSWORD_DEFAULT;

                switch ($algo){
                    default:
                    case "PASSWORD_DEFAULT":
                        $value = password_hash($value, PASSWORD_DEFAULT);
                        break;
                    case "PASSWORD_BCRYPT":
                        $value = password_hash($value, PASSWORD_BCRYPT);
                        break;
                    case "PASSWORD_ARGON2I":
                        $value = password_hash($value, PASSWORD_ARGON2I);
                        break;
                    case "PASSWORD_ARGON2ID":
                        $value = password_hash($value, PASSWORD_ARGON2ID);
                        break;
                }

                if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData(MetaFieldModel::PASSWORD_TYPE, $value))){
                    return false;
                }

                break;

			// ADDRESS_TYPE
			case MetaFieldModel::ADDRESS_TYPE:
			
				$savedFieldValue = $this->get($this->fieldModel->getDbName());

				if($savedFieldValue != $value){
			
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData(MetaFieldModel::ADDRESS_TYPE, $value))){
						return false;
					}

					$coordinates = GeoLocation::getCoordinates($value);

					if(
						!empty($coordinates) and
						$coordinates['lat'] !== null and
						$coordinates['lng'] !== null
					){
						if(!$this->set( $this->fieldModel->getDbName().'_lat', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $coordinates['lat']))){
							return false;
						}

						if(!$this->set( $this->fieldModel->getDbName().'_lng', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $coordinates['lng']))){
							return false;
						}

						$city = GeoLocation::getCity($coordinates['lat'], $coordinates['lng']);

						if(!empty($city)){
							if(!$this->set( $this->fieldModel->getDbName().'_city', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $city))){
								return false;
							}
						}
					}
				}
			
				break;
			
			// CURRENCY_TYPE
			case MetaFieldModel::CURRENCY_TYPE:
			
				$mandatory_keys = [
					'amount' => [
						'required' => true,
						'type' => 'float|double|integer',
					],
					'unit' => [
						'required' => true,
						'type' => 'string',
					],
				];
			
				$validator = new ArgumentsArrayValidator();
			
				if(!$validator->validate($mandatory_keys, $value)){
					return false;
				}
			
				$amount = $value['amount'];
				$unit = $value['unit'];
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$saved_field_unit = $this->get( $this->fieldModel->getDbName().'_currency');
			
				if($savedFieldValue !== $amount){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData(MetaFieldModel::CURRENCY_TYPE, $amount))){
						return false;
					}
				}
			
				if($saved_field_unit !== $unit){
					if(!$this->set( $this->fieldModel->getDbName().'_currency', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $unit))){
						return false;
					}
				}
			
				break;
			
			// DATE_RANGE_TYPE
			case MetaFieldModel::DATE_RANGE_TYPE:
			
				if(!is_array($value)){
					return false;
				}
			
				$value = implode(" - ", $value);
				if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
					return false;
				}
			
				break;

			// EMBED_TYPE
			case MetaFieldModel::EMBED_TYPE:
			
				$embed = (new \WP_Embed())->shortcode([
					'width' => 180,
					'height' => 135,
				], $value);
			
				if(!Strings::contains('<iframe', $embed)){
					return false;
				}
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}
			
				break;
			
			// FILE_TYPE
			case MetaFieldModel::FILE_TYPE:
			
				$mandatory_keys = [
					'url' => [
						'required' => true,
						'type' => 'string',
					],
					'label' => [
						'required' => false,
						'type' => 'string',
					],
				];
			
				$validator = new ArgumentsArrayValidator();
			
				if(!$validator->validate($mandatory_keys, $value)){
					return false;
				}
			
				$url = $value['url'];
				$label = (isset($value['label']) and !empty($value['label'])) ? $value['label'] : $url;
			
				$wpAttachment = WPAttachment::fromUrl($url);
				$idFile = $wpAttachment->getId();
				$isImage = $wpAttachment->isImage();
				$isVideo = $wpAttachment->isVideo();
				$fileData = $wpAttachment;
			
				if($fileData->isEmpty()){
					return false;
				}
			
				if($isImage or $isVideo){
					return false;
				}
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$saved_field_label = $this->get( $this->fieldModel->getDbName().'_label');
				$saved_file_id = $this->get( $this->fieldModel->getDbName().'_id');
			
				if($idFile !== $saved_file_id){
					if(!$this->set( $this->fieldModel->getDbName().'_id', $idFile)){
						return false;
					}
				}
			
				if($savedFieldValue !== $url){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $url))){
						return false;
					}
				}
			
				if($saved_field_label !== $label){
					if(!$this->set( $this->fieldModel->getDbName().'_label', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $label))){
						return false;
					}
				}
			
				break;
			
			// GALLERY_TYPE
			case MetaFieldModel::GALLERY_TYPE:
			
				if(!is_array($value)){
					return false;
				}
			
				$idFiles = [];
				$files = [];

				foreach ($value as $image){
					$wpAttachment = WPAttachment::fromUrl($image);
					$isImage = $wpAttachment->isImage();
					$idFile = $wpAttachment->getId();
			
					if($isImage){
						$idFiles[] = $idFile;
						$files[] = $image;
					}
				}

				if(empty($idFiles)){
					return false;
				}
			
				$idFiles = implode(",", $idFiles);
				$savedFileIds = $this->get( $this->fieldModel->getDbName().'_id');
			
				if($savedFileIds !== $idFiles){
					if(!$this->set( $this->fieldModel->getDbName().'_id', $idFiles)){
						return false;
					}
				}
			
				$savedFieldValue = $this->get($this->fieldModel->getDbName());
			
				if($savedFieldValue != $value){
					if(!$this->set($this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $files))){
						return false;
					}
				}
			
				break;
			
			// IMAGE_TYPE
			case MetaFieldModel::IMAGE_TYPE:
			
				$wpAttachment = WPAttachment::fromUrl($value);
				$isImage = $wpAttachment->isImage();
				$idFile = $wpAttachment->getId();
			
				if(!$isImage){
					return false;
				}
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$saved_file_id = $this->get( $this->fieldModel->getDbName().'_id');
			
				if($saved_file_id !== $idFile){
					if(!$this->set( $this->fieldModel->getDbName().'_id', $idFile)){
						return false;
					}
				}
			
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}
			
				break;
			
			// LENGTH_TYPE
			case MetaFieldModel::LENGTH_TYPE:
			
				$mandatory_keys = [
					'length' => [
						'required' => true,
						'type' => 'float|double|integer',
					],
					'unit' => [
						'required' => true,
						'type' => 'string',
					],
				];
			
				$validator = new ArgumentsArrayValidator();
			
				if(!$validator->validate($mandatory_keys, $value)){
					return false;
				}
			
				$length = $value['length'];
				$unit = $value['unit'];
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$saved_field_unit = $this->get( $this->fieldModel->getDbName().'_length');
			
				if($savedFieldValue !== $length){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData(MetaFieldModel::WEIGHT_TYPE, $length))){
						return false;
					}
				}
			
				if($saved_field_unit !== $unit){
					if(!$this->set( $this->fieldModel->getDbName().'_length', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $unit))){
						return false;
					}
				}
			
				break;
			
			case MetaFieldModel::NUMBER_TYPE:
			case MetaFieldModel::RANGE_TYPE:

				$min = $this->fieldModel->getAdvancedOption('min');
				$max = $this->fieldModel->getAdvancedOption('max');
			
				if($min !== null and (int)$value < (int)$min){
					return false;
				}
			
				if($max !== null and (int)$value > (int)$max){
					return false;
				}

				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}
			
				break;

			// LIST_TYPE
			case MetaFieldModel::LIST_TYPE:
				if(!is_array($value)){
					return false;
				}

				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}

				break;

            // QR_CODE_TYPE
            case MetaFieldModel::QR_CODE_TYPE:

                if(!Strings::isUrl($value)){
                    return false;
                }

                $savedFieldValue = $this->get( $this->fieldModel->getDbName());
                $savedQRCodeValue = $this->get( $this->fieldModel->getDbName().'_qr_code_value');

                if($savedFieldValue != $value){
                    if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
                        return false;
                    }
                }

                // Generate QR Code
                try {
                    $writer = new PngWriter();
                    $qrCode = new QrCode(
                        $value,
                        new Encoding('UTF-8'),
                        new ErrorCorrectionLevelLow(),
                        200,
                        0,
                        new RoundBlockSizeModeMargin(),
                        new Color(0, 0, 0),
                        new Color(255, 255, 255)
                    );

                    $cacaca = $writer->write($qrCode);

                    $QRCodeValueObject = json_encode([
                        'img' => $cacaca->getDataUri(),
                        'resolution' => 200,
                        'colorLight' => '#ffffff',
                        'colorDark' => '#000000',
                    ]);

                    // qr_code_value
                    if($savedQRCodeValue !== $QRCodeValueObject){
                        if(!$this->set( $this->fieldModel->getDbName().'_qr_code_value', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $QRCodeValueObject))){
                            return false;
                        }
                    }

                } catch (\Exception $exception){
                    return false;
                }

                break;

			// REPEATER_TYPE
			case MetaFieldModel::REPEATER_TYPE:
			
				if(!is_array($value)){
					return false;
				}

				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				if($savedFieldValue != $value){

					$values = NestedValues::addOrUpdateRawValue(
						$this->fieldModel,
						(empty($savedFieldValue) or !is_array($savedFieldValue)) ? [] : $savedFieldValue,
						$value
					);

					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $values))){
						return false;
					}
				}
			
				break;
			
			// FLEXIBLE_CONTENT_TYPE
			case MetaFieldModel::FLEXIBLE_CONTENT_TYPE:
			
				if(!is_array($value)){
					return false;
				}
			
				if(!isset($value['blocks'])){
					return false;
				}

				$savedFieldValue = $this->get( $this->fieldModel->getDbName());

				if($savedFieldValue != $value){

					$values = [
						'blocks' => []
					];

					foreach ($value['blocks'] as $block_index => $block){
						if(is_array($block)){
							foreach ($block as $block_name => $block_values){
								if(is_array($block_values)){
									$values['blocks'][(int)$block_index] = NestedValues::formatBlockValues(
										$this->fieldModel,
										$block_name,
										$block_values
									);
								}
							}
						}
					}

					if($savedFieldValue != $values){
						if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $values))){
							return false;
						}
					}
				}

				break;
			
			// POST_TYPE
			case MetaFieldModel::POST_TYPE:

				$rawValue = Sanitizer::sanitizeRawData($metaFieldModelType, $value);
				$rawValue = implode(",",$rawValue);
				$command = new HandleRelationsCommand($this->fieldModel, $rawValue, $this->location, $this->belongsTo);

				return $command->execute();

				break;
			
			// SELECT_TYPE
			case MetaFieldModel::RADIO_TYPE:
			case MetaFieldModel::SELECT_TYPE:
			
				if(in_array($value, $this->fieldModel->getOptionValues())){
					$savedFieldValue = $this->get( $this->fieldModel->getDbName());
					if($savedFieldValue != $value){
						if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
							return false;
						}
					}
			
					return true;
				}
			
				return false;
			
				break;
			
			// SELECT_MULTI_TYPE
			case MetaFieldModel::CHECKBOX_TYPE:
			case MetaFieldModel::SELECT_MULTI_TYPE:
			
				if(!is_array($value)){
					return false;
				}
			
				$optionValues = $this->fieldModel->getOptionValues();
			
				foreach ($value as $item){
					if(!in_array($item, $optionValues)){
						return false;
					}
				}
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}
			
				break;

			// TABLE_TYPE
			case MetaFieldModel::TABLE_TYPE:

				if(!is_array($value)){
					return false;
				}

				$generator = new TableFieldGenerator(json_encode($value));

				if(!$generator->theJSONIsValid()){
					return false;
				}

				if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
					return false;
				}

				break;
			
			// VIDEO_TYPE
			case MetaFieldModel::VIDEO_TYPE:
			
				$wpAttachment = WPAttachment::fromUrl($value);
				$isVideo = $wpAttachment->isVideo();
				$idFile = $wpAttachment->getId();
			
				if(!$isVideo){
					return false;
				}
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$saved_file_id = $this->get( $this->fieldModel->getDbName().'_id');
			
				if($saved_file_id !== $idFile){
					if(!$this->set( $this->fieldModel->getDbName().'_id', $idFile)){
						return false;
					}
				}
			
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}
			
				break;
			
			// WEIGHT_TYPE
			case MetaFieldModel::WEIGHT_TYPE:
			
				$mandatory_keys = [
					'weight' => [
						'required' => true,
						'type' => 'float|double|integer',
					],
					'unit' => [
						'required' => true,
						'type' => 'string',
					],
				];
			
				$validator = new ArgumentsArrayValidator();
			
				if(!$validator->validate($mandatory_keys, $value)){
					return false;
				}
			
				$weight = $value['weight'];
				$unit = $value['unit'];
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$saved_field_unit = $this->get( $this->fieldModel->getDbName().'_weight');
			
				if($savedFieldValue !== $weight){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData(MetaFieldModel::WEIGHT_TYPE, $weight))){
						return false;
					}
				}
			
				if($saved_field_unit !== $unit){
					if(!$this->set( $this->fieldModel->getDbName().'_weight', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $unit))){
						return false;
					}
				}
			
				break;

			// COUNTRY_TYPE
			case MetaFieldModel::COUNTRY_TYPE:
				$mandatory_keys = [
					'value' => [
						'required' => true,
						'type' => 'string',
					],
					'country' => [
						'required' => true,
						'type' => 'string',
					],
				];

				$validator = new ArgumentsArrayValidator();

				if(!$validator->validate($mandatory_keys, $value)){
					return false;
				}

				$countryValue = $value['value'];
				$countryCode = $value['country'];

				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$savedFieldCountry = $this->get( $this->fieldModel->getDbName().'_country');

				if($savedFieldValue !== $countryValue){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $countryValue))){
						return false;
					}
				}

				if($savedFieldCountry !== $countryCode){
					if(!$this->set( $this->fieldModel->getDbName().'_country', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $countryCode))){
						return false;
					}
				}

				break;

			// URL_TYPE
			case MetaFieldModel::URL_TYPE:

				if(is_string($value)){
					$value = [
						'url' => $value,
						'label' => $value,
					];
				}
			
				$mandatory_keys = [
					'url' => [
						'required' => true,
						'type' => 'string',
					],
					'label' => [
						'required' => false,
						'type' => 'string',
					],
				];
			
				$validator = new ArgumentsArrayValidator();
			
				if(!$validator->validate($mandatory_keys, $value)){
					return false;
				}
			
				$url = $value['url'];
				$label = (isset($value['label']) and !empty($value['label'])) ? $value['label'] : $url;

				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				$savedFieldLabel = $this->get( $this->fieldModel->getDbName().'_label');
			
				if($savedFieldValue !== $url){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $url))){
						return false;
					}
				}
			
				if($savedFieldLabel !== $label){
					if(!$this->set( $this->fieldModel->getDbName().'_label', Sanitizer::sanitizeRawData(MetaFieldModel::TEXT_TYPE, $label))){
						return false;
					}
				}
			
				break;
			
			// RATING_TYPE
			case MetaFieldModel::RATING_TYPE:
				if(!is_numeric($value)){
					return false;
				}
			
				if($value < 1){
					return false;
				}
			
				if($value > 10){
					return false;
				}
			
				$savedFieldValue = $this->get( $this->fieldModel->getDbName());
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}
				break;
			
			// Default behaviour
			default:
				$savedFieldValue = $this->get($this->fieldModel->getDbName());
				if($savedFieldValue != $value){
					if(!$this->set( $this->fieldModel->getDbName(), Sanitizer::sanitizeRawData($metaFieldModelType, $value))){
						return false;
					}
				}
		}

		return true;
	}
}