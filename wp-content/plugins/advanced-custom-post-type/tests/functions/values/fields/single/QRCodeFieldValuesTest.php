<?php

namespace ACPT\Tests;

use ACPT\Core\Models\Meta\MetaFieldModel;
use ACPT\Constants\MetaTypes;

class QRCodeFieldValuesTest extends AbstractTestCase
{
	/**
	 * @test
	 */
	public function can_add_acpt_meta_field_value()
	{
		$new_group = save_acpt_meta_group([
			'name' => 'new-group',
			'label' => 'New group',
			'belongs' => [
				[
					'belongsTo' => MetaTypes::CUSTOM_POST_TYPE,
					'operator'  => "=",
					"find"      => "page",
					"logic"     => "OR"
				]
			],
			'boxes' => [
				[
					'name' => 'box_name',
					'label' => null,
					'fields' => [
						[
							'name' => 'qr_code_field',
							'label' => 'QR code field',
							'type' => MetaFieldModel::QR_CODE_TYPE,
							'showInArchive' => false,
							'isRequired' => false,
							'defaultValue' => "foo",
							'description' => "lorem ipsum dolor facium",
						]
					]
				],
			],
		]);

		$new_page = register_acpt_option_page([
			'menu_slug' => 'new-page',
			'page_title' => 'New page',
			'menu_title' => 'New page menu title',
			'icon' => 'admin-appearance',
			'capability' => 'manage_options',
			'description' => 'lorem ipsum',
			'position' => 77,
		]);

		$this->assertTrue($new_group);
		$this->assertTrue($new_page);

		foreach ($this->dataProvider() as $key => $value){
			$add_acpt_meta_field_value = save_acpt_meta_field_value([
				$key => $value,
				'box_name' => 'box_name',
				'field_name' => 'qr_code_field',
				'value' => "https://acpt.io",
			]);

			$this->assertTrue($add_acpt_meta_field_value);

			$acpt_field = get_acpt_field([
				$key => $value,
				'box_name' => 'box_name',
				'field_name' => 'qr_code_field',
			]);

			$this->assertEquals("<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAIAAAAiOjnJAAAACXBIWXMAAA7EAAAOxAGVKw4bAAADSUlEQVR4nO3dwWrbQBRA0br0/3853XXhgKjEu/Kzc86ui8aOuAzkMaN5fH19/YJpv1/9BfhMwiIhLBLCIvHn6d+Px+Ml32PEwR8iB7/XtT9frj2oa99wv++/lxWLhLBICIuEsEgIi4SwSAiLhLBIPA9IDyzZBzE+mRz/rHHv+OStWCSERUJYJIRFQlgkhEVCWCSEReLEgPTA+CBxfCT4qWPVtU/eikVCWCSERUJYJIRFQlgkhEVCWCRmBqRv7VOPvb+WFYuEsEgIi4SwSAiLhLBICIuEsEgYkB4xO73MikVCWCSERUJYJIRFQlgkhEVCWCRmBqRLXpJ5YP9h+WvWPnkrFglhkRAWCWGREBYJYZEQFglhkTgxIN0/LTwwfov9nZtL3/HJW7FICIuEsEgIi4SwSAiLhLBICIvEY+0WxOXuvPXpHVmxSAiLhLBICIuEsEgIi4SwSAiLxPMO0js3K44fe7+2q3P8fx248wdeM/U0rFgkhEVCWCSERUJYJIRFQlgkhEXixBH7Oyd44/PMO+2fgt7wWVYsEsIiISwSwiIhLBLCIiEsEsIi8XzEfsmMcdySDZ/j1u74tWKREBYJYZEQFglhkRAWCWGREBaJ5x2k43O/JSfiD9z5WXf+wAM3jFWtWCSERUJYJIRFQlgkhEVCWCSEReLEEftrltwRv2Rn7JKvcWBqQm7FIiEsEsIiISwSwiIhLBLCIiEsEj/lFvu1R9H/ufO6pWtc0sTrCYuEsEgIi4SwSAiLhLBICIvER72DdP+wd8nB/GufdYoVi4SwSAiLhLBICIuEsEgIi4SwSOS32I/bf6X7kgc1zg5SXk9YJIRFQlgkhEVCWCSERUJYJGbeQbp2H+P/WHJV/Z1XVo2/GPY7KxYJYZEQFglhkRAWCWGREBYJYZHIL2laYsnVTkuurLqBFYuEsEgIi4SwSAiLhLBICIuEsEj8lAHpuPGh5f7Xk55ixSIhLBLCIiEsEsIiISwSwiIhLBIzA9JPfevm2vHjP+Pn6Kd+oBWLhLBICIuEsEgIi4SwSAiLhLBInBiQLhkJjhuf7r71OXq32LOasEgIi4SwSAiLhLBICIuEsEg8PnXzJ69lxSIhLBLCIiEsEsIi8RdzkdyhqGdqxgAAAABJRU5ErkJggg==' alt='https://acpt.io' width='200' height='200' />", $acpt_field);
		}
	}

    /**
     * @depends can_add_acpt_meta_field_value
     * @test
     */
	public function can_edit_acpt_meta_field_value()
	{
		foreach ($this->dataProvider() as $key => $value){
			$edit_acpt_meta_field_value = save_acpt_meta_field_value([
				$key => $value,
				'box_name' => 'box_name',
				'field_name' => 'qr_code_field',
				'value' => "https://google.com",
			]);

			$this->assertTrue($edit_acpt_meta_field_value);

			$acpt_field = get_acpt_field([
				$key => $value,
				'box_name' => 'box_name',
				'field_name' => 'qr_code_field',
			]);

			$this->assertEquals("<img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAMgAAADICAIAAAAiOjnJAAAACXBIWXMAAA7EAAAOxAGVKw4bAAADf0lEQVR4nO3dQY4cIRAAQY+1///y+gUcsCoNrCOuHjFjbYpDiaY/vx7x/f299fnP5zOyzq76e1fr3+b36R/AzyQsEsIiISwSwiIhLBLCIvG1+od63rOyO6eZmuvU86F6vnXb38uORUJYJIRFQlgkhEVCWCSERWI5x1qZmvfU85vV79z9/bvr33Zu7NTfy45FQlgkhEVCWCSERUJYJIRFYnuOdZt6LrVr6ve8zo5FQlgkhEVCWCSERUJYJIRF4vk5Vn3+6bbPv8KORUJYJIRFQlgkhEVCWCSERWJ7jnXbfOXUvVO3PV95av0VOxYJYZEQFglhkRAWCWGREBaJ5Rzrlffi1abOV02tv7vOKXYsEsIiISwSwiIhLBLCIiEsEp/bzlfdxn1Xf8eORUJYJIRFQlgkhEVCWCSEReLYIZ76eb1d9X1XU165x8uORUJYJIRFQlgkhEVCWCSEReK6OdbKK/en3zbH2l1n1+p77VgkhEVCWCSERUJYJIRFQlgklvdjnZoPnTqPNTUHqs8/3XZfl/NY/FPCIiEsEsIiISwSwiIhLBJj92Odeq6tdur81uv3bNmxSAiLhLBICIuEsEgIi4SwSIwNh+r5U/083alzZq/M7XZ/jx2LhLBICIuEsEgIi4SwSAiLxNhzhVNuO/9U3ztVz+F215n6vB2LhLBICIuEsEgIi4SwSAiLxHL4cer8065Tz9+9Pt+qP2/HIiEsEsIiISwSwiIhLBLCIrE9x9r+gsvuf3rlPNZt92N5rpArCIuEsEgIi4SwSAiLhLBI5OexptZ3r9W/MTWHs2OREBYJYZEQFglhkRAWCWGRGHtf4SmvnGdauW0ON7W+HYuEsEgIi4SwSAiLhLBICIvE1yvnh+rn9ernB6ecmkvtsmOREBYJYZEQFglhkRAWCWGR2H5fYe22edJt9129ck7LjkVCWCSERUJYJIRFQlgkhEViOcdaue09g7edJ5s673Xb/2uXHYuEsEgIi4SwSAiLhLBICIvE9hzrp3rl3vZT58O8r5ArCIuEsEgIi4SwSAiLhLBI/HdzrN35zan7tE7Nz6buFbNjkRAWCWGREBYJYZEQFglhkdieY73yHsApt82rpuZbU/Oq1eftWCSERUJYJIRFQlgkhEVCWCSWc6zbnqebMvWc3dS8Z3f92tRczY5FQlgkhEVCWCSERUJYJIRF4g+0ClqxFzqKJQAAAABJRU5ErkJggg==' alt='https://google.com' width='200' height='200' />", $acpt_field);
		}
	}

    /**
     * @depends can_edit_acpt_meta_field_value
     * @test
     */
    public function can_delete_acpt_meta_field_value()
    {
	    foreach ($this->dataProvider() as $key => $value){
		    $delete_acpt_meta_field_value = delete_acpt_meta_field_value([
			    $key => $value,
			    'box_name' => 'box_name',
			    'field_name' => 'qr_code_field',
		    ]);

		    $this->assertTrue($delete_acpt_meta_field_value);
	    }

        $delete_acpt_meta_box = delete_acpt_meta_box('new-group', 'box_name');

        $this->assertTrue($delete_acpt_meta_box);

	    foreach ($this->dataProvider() as $key => $value){
		    $acpt_field = get_acpt_field([
			    $key => $value,
			    'box_name' => 'box_name',
			    'field_name' => 'qr_code_field',
		    ]);

		    $this->assertNull($acpt_field);
	    }

	    $delete_group = delete_acpt_meta_group('new-group');
	    $delete_acpt_option_page = delete_acpt_option_page('new-page', true);

	    $this->assertTrue($delete_group);
	    $this->assertTrue($delete_acpt_option_page);
    }
}