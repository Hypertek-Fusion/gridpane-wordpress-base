<?php
namespace Advanced_Themer_Bricks;
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


class AT__Framework
{
    static public $at_framework = [
        "settings" => [
            "version" => [
                "variables" => "1.0.0",
                "global_classes" => "1.0.0",
                "global_colors" => "1.0.0",
                "theme_settings" => "1.0.0",
                "advanced_css" => "1.0.0",
            ]
        ],
        "values" => [
            "variables_cat" => '
                [
                    {
                        "id": "at_site",
                        "name": "Site",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grids",
                        "name": "Grids",
                        "cssCategory": "_grid",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_spacing",
                        "name": "Spacing",
                        "cssCategory": "_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_gap",
                        "name": "Gap",
                        "cssCategory": "_gap",
                        "description": "The container-gap is mapped under <strong>Theme Styles > Element – Section</strong>, while the content-gap is used in both the default <strong>Container and Block</strong> settings.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_typography",
                        "name": "Typography",
                        "cssCategory": "_typography",
                        "description": "The following variables control heading and text sizes across your entire website, and are mapped under <strong>Theme Styles > Typography</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn",
                        "name": "Button",
                        "at_framework": true,
                        "description": "The following variables are shared across all button variants and are mapped under <strong>Theme Styles > Elements - Button > Style - Default</strong>.",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary",
                        "name": "Button - Primary",
                        "at_framework": true,
                        "description": "The following variables define the primary button’s colors and are mapped under <strong>Theme Styles > Elements - Button > Style - Primary</strong>.",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-outline",
                        "name": "Button - Primary Outline",
                        "at_framework": true,
                        "description": "The following variables define the primary button’s colors on outline variants and are mapped under <strong>Theme Styles > Elements - Button > Style - Primary</strong>.",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary",
                        "name": "Button - Secondary",
                        "description": "The following variables define the secondary button’s colors and are mapped under <strong>Theme Styles > Elements - Button > Style - Secondary</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-outline",
                        "name": "Button - Secondary Outline",
                        "description": "The following variables define the secondary button’s colors on outline variants and are mapped under <strong>Theme Styles > Elements - Button > Style - Secondary</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light",
                        "name": "Button - Light",
                        "description": "The following variables define the light button’s colors and are mapped under <strong>Theme Styles > Elements - Button > Style - Light</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-outline",
                        "name": "Button - Light Outline",
                        "description": "The following variables define the light button’s colors on outline variants and are mapped under <strong>Theme Styles > Elements - Button > Style - Light</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark",
                        "name": "Button - Dark",
                        "description": "The following variables define the dark button’s colors and are mapped under <strong>Theme Styles > Elements - Button > Style - Dark</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-outline",
                        "name": "Button - Dark Outline",
                        "description": "The following variables define the dark button’s colors on outline variants and are mapped under <strong>Theme Styles > Elements - Button > Style - Dark</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-size-small",
                        "name": "Button - Size Small",
                        "description": "The following variables define the small button’s sizes and are mapped under <strong>Theme Styles > Elements - Button > Size - Small</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-size-medium",
                        "name": "Button - Size Medium",
                        "description": "The following variables define the medium button’s sizes and are mapped under <strong>Theme Styles > Elements - Button > Size - Medium</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-size-large",
                        "name": "Button - Size Large",
                        "description": "The following variables define the large button’s sizes and are mapped under <strong>Theme Styles > Elements - Button > Size - Large</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-size-extra-large",
                        "name": "Button - Size Extra Large",
                        "description": "The following variables define the extra large button’s sizes and are mapped under <strong>Theme Styles > Elements - Button > Size - Extra Large</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_links",
                        "name": "Links",
                        "description": "The following variables define your link’s colors and are mapped under <strong>Theme Styles > Links > Typography</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_marks",
                        "name": "Marks",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_border",
                        "name": "Border",
                        "cssCategory": "_border",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_box-shadow",
                        "name": "Box Shadow",
                        "description": "The following values can be used within any Box-Shadow modal by navigating to <strong>Color > Raw</strong>.",
                        "cssCategory": "_border",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_filter",
                        "name": "Filters / Transitions",
                        "cssCategory": "_filter",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_a11y",
                        "name": "A11y",
                        "description": "The focus-color and focus-width are mapped in <strong>Theme Styles > Typography > Focus Outline</strong>, while the focus-offset is used in the <strong>global file in Advanced CSS</strong>.",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_svg",
                        "name": "SVG",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    }
                ]',
            "variables" => '
                [
                    {
                        "id": "at_site-box-width",
                        "name": "at-site-box-max-width",
                        "type": "static",
                        "category": "at_site",
                        "value": "1300px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_section-max-width",
                        "name": "at-section-max-width",
                        "type": "static",
                        "category": "at_site",
                        "value": "100%",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_blog-width",
                        "name": "at-blog-width",
                        "type": "static",
                        "category": "at_site",
                        "value": "900px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_section--alt-background",
                        "name": "at-section--alt-background",
                        "type": "color",
                        "category": "at_site",
                        "value": "var(--at-neutral-t-6)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id":"at_header-height",
                        "name":"at-header-height"
                        ,"type":"static",
                        "category":"at_site",
                        "value":"0px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--1",
                        "name": "at-grid--1",
                        "type": "static",
                        "category": "at_grids",
                        "value": "minmax(0,1fr)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--2",
                        "name": "at-grid--2",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 2, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--3",
                        "name": "at-grid--3",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 3, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--4",
                        "name": "at-grid--4",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 4, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--5",
                        "name": "at-grid--5",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 5, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--6",
                        "name": "at-grid--6",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 6, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--7",
                        "name": "at-grid--7",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 7, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--8",
                        "name": "at-grid--8",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 8, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--9",
                        "name": "at-grid--9",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 9, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--10",
                        "name": "at-grid--10",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 10, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--11",
                        "name": "at-grid--11",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 11, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--12",
                        "name": "at-grid--12",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( 12, minmax(0,1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--1-2",
                        "name": "at-grid--1-2",
                        "type": "static",
                        "category": "at_grids",
                        "value": "minmax(0,1fr)  minmax(0,2fr) ",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--2-1",
                        "name": "at-grid--2-1",
                        "type": "static",
                        "category": "at_grids",
                        "value": "minmax(0,2fr) minmax(0,1fr) ",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--1-3",
                        "name": "at-grid--1-3",
                        "type": "static",
                        "category": "at_grids",
                        "value": "minmax(0,1fr)  minmax(0,3fr) ",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid--3-1",
                        "name": "at-grid--3-1",
                        "type": "static",
                        "category": "at_grids",
                        "value": "minmax(0,3fr) minmax(0,1fr) ",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid-auto-col-min-width",
                        "name": "at-grid-auto-col-min-width",
                        "type": "static",
                        "category": "at_grids",
                        "value": "270px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid-auto-fit",
                        "name": "at-grid-auto-fit",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( auto-fit, minmax( min( var(--at-grid-auto-col-min-width), 100%), 1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid-auto-fill",
                        "name": "at-grid-auto-fill",
                        "type": "static",
                        "category": "at_grids",
                        "value": "repeat( auto-fill, minmax( min( var(--at-grid-auto-col-min-width), 100%), 1fr) )",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--3xs",
                        "scaleId": "pgcdtw",
                        "suffix": "3xs",
                        "name": "at-space--3xs",
                        "step": -3,
                        "multiplier": 0.296,
                        "value": "calc(var(--at-space--s) * 0.296)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--2xs",
                        "scaleId": "pgcdtw",
                        "suffix": "2xs",
                        "name": "at-space--2xs",
                        "step": -2,
                        "multiplier": 0.444,
                        "value": "calc(var(--at-space--s) * 0.444)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--xs",
                        "scaleId": "pgcdtw",
                        "suffix": "xs",
                        "name": "at-space--xs",
                        "step": -1,
                        "multiplier": 0.667,
                        "value": "calc(var(--at-space--s) * 0.667)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--s",
                        "scaleId": "pgcdtw",
                        "label": "at-space-",
                        "suffix": "s",
                        "name": "at-space--s",
                        "step": 0,
                        "smallSteps": 3,
                        "largeSteps": 6,
                        "multiplier": 1,
                        "type": "scale",
                        "scaleType": 1.5,
                        "value": "clamp(calc(1rem * (10 / var(--base-font))), calc(1rem * ((((-1 * var(--min-viewport)) / var(--base-font)) * ((20 - 10) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font))) + (10 / var(--base-font)))) + (((20 - 10) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font)) * 100) * var(--clamp-unit), calc(1rem * (20 / var(--base-font))));",
                        "base": true,
                        "min": "10",
                        "max": "20",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--m",
                        "scaleId": "pgcdtw",
                        "suffix": "m",
                        "name": "at-space--m",
                        "step": 1,
                        "multiplier": 1.5,
                        "value": "calc(var(--at-space--s) * 1.5)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--l",
                        "scaleId": "pgcdtw",
                        "suffix": "l",
                        "name": "at-space--l",
                        "step": 2,
                        "multiplier": 2.25,
                        "value": "calc(var(--at-space--s) * 2.25)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--xl",
                        "scaleId": "pgcdtw",
                        "suffix": "xl",
                        "name": "at-space--xl",
                        "step": 3,
                        "multiplier": 3.375,
                        "value": "calc(var(--at-space--s) * 3.375)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--2xl",
                        "scaleId": "pgcdtw",
                        "suffix": "2xl",
                        "name": "at-space--2xl",
                        "step": 4,
                        "multiplier": 5.063,
                        "value": "calc(var(--at-space--s) * 5.063)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_space--3xl",
                        "scaleId": "pgcdtw",
                        "suffix": "3xl",
                        "name": "at-space--3xl",
                        "step": 5,
                        "multiplier": 7.594,
                        "value": "calc(var(--at-space--s) * 7.594)",
                        "type": "scale",
                        "category": "at_spacing",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_section-padding-block",
                        "name": "at-section-padding-block",
                        "type": "static",
                        "category": "at_spacing",
                        "value": "var(--at-space--2xl)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_gutter",
                        "name": "at-gutter",
                        "type": "static",
                        "category": "at_spacing",
                        "value": "var(--at-space--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_block-overlap",
                        "name": "at-block-overlap",
                        "type": "static",
                        "category": "at_spacing",
                        "value": "var(--at-section-padding-block)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_container-gap",
                        "name": "at-container-gap",
                        "type": "static",
                        "category": "at_gap",
                        "value": "var(--at-space--l)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_gap-gap",
                        "name": "at-content-gap",
                        "type": "static",
                        "category": "at_gap",
                        "value": "var(--at-space--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_gap-gap--s",
                        "name": "at-content-gap--s",
                        "type": "static",
                        "category": "at_gap",
                        "value": "var(--at-space--xs)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_gap-gap--xs",
                        "name": "at-content-gap--xs",
                        "type": "static",
                        "category": "at_gap",
                        "value": "var(--at-space--2xs)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid-gap",
                        "name": "at-grid-gap",
                        "type": "static",
                        "category": "at_gap",
                        "value": "var(--at-space--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid-gap--s",
                        "name": "at-grid-gap--s",
                        "type": "static",
                        "category": "at_gap",
                        "value": "var(--at-space--xs)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_grid-gap--l",
                        "name": "at-grid-gap--l",
                        "type": "static",
                        "category": "at_gap",
                        "value": "var(--at-space--m)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_heading--2xs",
                        "scaleId": "wwotsj",
                        "suffix": "2xs",
                        "name": "at-heading--2xs",
                        "step": -2,
                        "multiplier": 0.64,
                        "value": "calc(var(--at-heading--s) * 0.64)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_heading--xs",
                        "scaleId": "wwotsj",
                        "suffix": "xs",
                        "name": "at-heading--xs",
                        "step": -1,
                        "multiplier": 0.8,
                        "value": "calc(var(--at-heading--s) * 0.8)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_heading--s",
                        "scaleId": "wwotsj",
                        "label": "at-heading-",
                        "suffix": "s",
                        "name": "at-heading--s",
                        "step": 0,
                        "smallSteps": "2",
                        "largeSteps": "4",
                        "multiplier": 1,
                        "type": "scale",
                        "scaleType": 1.25,
                        "value": "clamp(calc(1rem * (18 / var(--base-font))), calc(1rem * ((((-1 * var(--min-viewport)) / var(--base-font)) * ((24 - 18) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font))) + (18 / var(--base-font)))) + (((24 - 18) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font)) * 100) * var(--clamp-unit), calc(1rem * (24 / var(--base-font))));",
                        "base": true,
                        "min": 18,
                        "max": "24",
                        "category": "at_typography",
                        "preview": "typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_heading--m",
                        "scaleId": "wwotsj",
                        "suffix": "m",
                        "name": "at-heading--m",
                        "step": 1,
                        "multiplier": 1.25,
                        "value": "calc(var(--at-heading--s) * 1.25)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_heading--l",
                        "scaleId": "wwotsj",
                        "suffix": "l",
                        "name": "at-heading--l",
                        "step": 2,
                        "multiplier": 1.563,
                        "value": "calc(var(--at-heading--s) * 1.563)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_heading--xl",
                        "scaleId": "wwotsj",
                        "suffix": "xl",
                        "name": "at-heading--xl",
                        "step": 3,
                        "multiplier": 1.953,
                        "value": "calc(var(--at-heading--s) * 1.953)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--2xs",
                        "scaleId": "jnoezm",
                        "suffix": "2xs",
                        "name": "at-text--2xs",
                        "step": -2,
                        "multiplier": 0.64,
                        "value": "calc(var(--at-text--s) * 0.64)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--xs",
                        "scaleId": "jnoezm",
                        "suffix": "xs",
                        "name": "at-text--xs",
                        "step": -1,
                        "multiplier": 0.8,
                        "value": "calc(var(--at-text--s) * 0.8)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--s",
                        "scaleId": "jnoezm",
                        "label": "at-text-",
                        "suffix": "s",
                        "name": "at-text--s",
                        "step": 0,
                        "smallSteps": "2",
                        "largeSteps": 6,
                        "multiplier": 1,
                        "type": "scale",
                        "scaleType": 1.25,
                        "value": "clamp(calc(1rem * (15 / var(--base-font))), calc(1rem * ((((-1 * var(--min-viewport)) / var(--base-font)) * ((18 - 15) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font))) + (15 / var(--base-font)))) + (((18 - 15) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font)) * 100) * var(--clamp-unit), calc(1rem * (18 / var(--base-font))));",
                        "base": true,
                        "min": "15",
                        "max": "18",
                        "category": "at_typography",
                        "preview": "typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--m",
                        "scaleId": "jnoezm",
                        "suffix": "m",
                        "name": "at-text--m",
                        "step": 1,
                        "multiplier": 1.25,
                        "value": "calc(var(--at-text--s) * 1.25)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--l",
                        "scaleId": "jnoezm",
                        "suffix": "l",
                        "name": "at-text--l",
                        "step": 2,
                        "multiplier": 1.563,
                        "value": "calc(var(--at-text--s) * 1.563)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--xl",
                        "scaleId": "jnoezm",
                        "suffix": "xl",
                        "name": "at-text--xl",
                        "step": 3,
                        "multiplier": 1.953,
                        "value": "calc(var(--at-text--s) * 1.953)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--2xl",
                        "scaleId": "jnoezm",
                        "suffix": "2xl",
                        "name": "at-text--2xl",
                        "step": 4,
                        "multiplier": 2.441,
                        "value": "calc(var(--at-text--s) * 2.441)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_text--3xl",
                        "scaleId": "jnoezm",
                        "suffix": "3xl",
                        "name": "at-text--3xl",
                        "step": 5,
                        "multiplier": 3.052,
                        "value": "calc(var(--at-text--s) * 3.052)",
                        "type": "scale",
                        "category": "at_typography",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-border-radius",
                        "name": "at-btn-border-radius",
                        "type": "static",
                        "category": "at_btn",
                        "value": "var(--at-radius--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-border-radius--hover",
                        "name": "at-btn-border-radius--hover",
                        "type": "static",
                        "category": "at_btn",
                        "value": "var(--at-radius--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-border-width",
                        "name": "at-btn-border-width",
                        "type": "static",
                        "category": "at_btn",
                        "value": "2px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-border-width--hover",
                        "name": "at-btn-border-width--hover",
                        "type": "static",
                        "category": "at_btn",
                        "value": "2px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-shadow",
                        "name": "at-btn-shadow",
                        "type": "static",
                        "category": "at_btn",
                        "value": "none",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-shadow--hover",
                        "name": "at-btn-shadow--hover",
                        "type": "static",
                        "category": "at_btn",
                        "value": "var(--at-shadow--l)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-outline-border-radius",
                        "name": "at-btn-outline-border-radius",
                        "type": "static",
                        "category": "at_btn",
                        "value": "var(--at-radius--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-outline-border-radius--hover",
                        "name": "at-btn-outline-border-radius--hover",
                        "type": "static",
                        "category": "at_btn",
                        "value": "var(--at-radius--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-outline-border-width",
                        "name": "at-btn-outline-border-width",
                        "type": "static",
                        "category": "at_btn",
                        "value": "2px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-outline-border-width--hover",
                        "name": "at-btn-outline-border-width--hover",
                        "type": "static",
                        "category": "at_btn",
                        "value": "2px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-outline-shadow",
                        "name": "at-btn-outline-shadow",
                        "type": "static",
                        "category": "at_btn",
                        "value": "none",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-outline-shadow--hover",
                        "name": "at-btn-outline-shadow--hover",
                        "type": "static",
                        "category": "at_btn",
                        "value": "var(--at-shadow--l)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-transition",
                        "name": "at-btn-transition",
                        "type": "static",
                        "category": "at_btn",
                        "value": "all var(--at-duration--fast) ease",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-color",
                        "name": "at-btn-primary-color",
                        "type": "color",
                        "category": "at_btn-primary",
                        "value": "var(--at-primary-l-6)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-color--hover",
                        "name": "at-btn-primary-color--hover",
                        "type": "color",
                        "category": "at_btn-primary",
                        "value": "var(--at-primary-l-6)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-background",
                        "name": "at-btn-primary-background",
                        "type": "color",
                        "category": "at_btn-primary",
                        "value": "var(--at-primary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-background--hover",
                        "name": "at-btn-primary-background--hover",
                        "type": "color",
                        "category": "at_btn-primary",
                        "value": "var(--at-primary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-border-color",
                        "name": "at-btn-primary-border-color",
                        "type": "color",
                        "category": "at_btn-primary",
                        "value": "var(--at-primary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-border-color--hover",
                        "name": "at-btn-primary-border-color--hover",
                        "type": "color",
                        "category": "at_btn-primary",
                        "value": "var(--at-primary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-outline-color",
                        "name": "at-btn-primary-outline-color",
                        "type": "color",
                        "category": "at_btn-primary-outline",
                        "value": "var(--at-primary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-outline-color--hover",
                        "name": "at-btn-primary-outline-color--hover",
                        "type": "color",
                        "category": "at_btn-primary-outline",
                        "value": "var(--at-primary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-outline-background",
                        "name": "at-btn-primary-outline-background",
                        "type": "color",
                        "category": "at_btn-primary-outline",
                        "value": "rgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-outline-background--hover",
                        "name": "at-btn-primary-outline-background--hover",
                        "type": "color",
                        "category": "at_btn-primary-outline",
                        "value": "vrgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-outline-border-color",
                        "name": "at-btn-primary-outline-border-color",
                        "type": "color",
                        "category": "at_btn-primary-outline",
                        "value": "var(--at-primary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-primary-outline-border-color--hover",
                        "name": "at-btn-primary-outline-border-color--hover",
                        "type": "color",
                        "category": "at_btn-primary-outline",
                        "value": "var(--at-primary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-color",
                        "name": "at-btn-secondary-color",
                        "type": "color",
                        "category": "at_btn-secondary",
                        "value": "var(--at-secondary-l-6)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-color--hover",
                        "name": "at-btn-secondary-color--hover",
                        "type": "color",
                        "category": "at_btn-secondary",
                        "value": "var(--at-secondary-l-6)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-background",
                        "name": "at-btn-secondary-background",
                        "type": "color",
                        "category": "at_btn-secondary",
                        "value": "var(--at-secondary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-background--hover",
                        "name": "at-btn-secondary-background--hover",
                        "type": "color",
                        "category": "at_btn-secondary",
                        "value": "var(--at-secondary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-border-color",
                        "name": "at-btn-secondary-border-color",
                        "type": "color",
                        "category": "at_btn-secondary",
                        "value": "var(--at-secondary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-border-color--hover",
                        "name": "at-btn-secondary-border-color--hover",
                        "type": "color",
                        "category": "at_btn-secondary",
                        "value": "var(--at-secondary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-outline-color",
                        "name": "at-btn-secondary-outline-color",
                        "type": "color",
                        "category": "at_btn-secondary-outline",
                        "value": "var(--at-secondary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-outline-color--hover",
                        "name": "at-btn-secondary-outline-color--hover",
                        "type": "color",
                        "category": "at_btn-secondary-outline",
                        "value": "var(--at-secondary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-outline-background",
                        "name": "at-btn-secondary-outline-background",
                        "type": "color",
                        "category": "at_btn-secondary-outline",
                        "value": "rgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-outline-background--hover",
                        "name": "at-btn-secondary-outline-background--hover",
                        "type": "color",
                        "category": "at_btn-secondary-outline",
                        "value": "rgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-outline-border-color",
                        "name": "at-btn-secondary-outline-border-color",
                        "type": "color",
                        "category": "at_btn-secondary-outline",
                        "value": "var(--at-secondary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-secondary-outline-border-color--hover",
                        "name": "at-btn-secondary-outline-border-color--hover",
                        "type": "color",
                        "category": "at_btn-secondary-outline",
                        "value": "var(--at-secondary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-color",
                        "name": "at-btn-light-color",
                        "type": "color",
                        "category": "at_btn-light",
                        "value": "var(--at-primary-d-4)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-color--hover",
                        "name": "at-btn-light-color--hover",
                        "type": "color",
                        "category": "at_btn-light",
                        "value": "var(--at-primary-d-4)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-background",
                        "name": "at-btn-light-background",
                        "type": "color",
                        "category": "at_btn-light",
                        "value": "var(--at-primary-l-5)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-background--hover",
                        "name": "at-btn-light-background--hover",
                        "type": "color",
                        "category": "at_btn-light",
                        "value": "var(--at-primary-l-4)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-border-color",
                        "name": "at-btn-light-border-color",
                        "type": "color",
                        "category": "at_btn-light",
                        "value": "var(--at-primary-l-5)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-border-color--hover",
                        "name": "at-btn-light-border-color--hover",
                        "type": "color",
                        "category": "at_btn-light",
                        "value": "var(--at-primary-l-4)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-outline-color",
                        "name": "at-btn-light-outline-color",
                        "type": "color",
                        "category": "at_btn-light-outline",
                        "value": "var(--at-primary-l-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-outline-color--hover",
                        "name": "at-btn-light-outline-color--hover",
                        "type": "color",
                        "category": "at_btn-light-outline",
                        "value": "var(--at-primary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-outline-background",
                        "name": "at-btn-light-outline-background",
                        "type": "color",
                        "category": "at_btn-light-outline",
                        "value": "rgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-outline-background--hover",
                        "name": "at-btn-light-outline-background--hover",
                        "type": "color",
                        "category": "at_btn-light-outline",
                        "value": "rgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-outline-border-color",
                        "name": "at-btn-light-outline-border-color",
                        "type": "color",
                        "category": "at_btn-light-outline",
                        "value": "var(--at-primary-l-5)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-light-outline-border-color--hover",
                        "name": "at-btn-light-outline-border-color--hover",
                        "type": "color",
                        "category": "at_btn-light-outline",
                        "value": "var(--at-primary-l-3)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-color",
                        "name": "at-btn-dark-color",
                        "type": "color",
                        "category": "at_btn-dark",
                        "at_framework": true,
                        "at_version": "1.0.0",
                        "value": "var(--at-primary-l-6)"
                    },
                    {
                        "id": "at_btn-dark-color--hover",
                        "name": "at-btn-dark-color--hover",
                        "type": "color",
                        "category": "at_btn-dark",
                        "value": "var(--at-primary-l-6)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-background",
                        "name": "at-btn-dark-background",
                        "type": "color",
                        "category": "at_btn-dark",
                        "value": "var(--at-primary-d-4)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-background--hover",
                        "name": "at-btn-dark-background--hover",
                        "type": "color",
                        "category": "at_btn-dark",
                        "value": "var(--at-primary-d-2)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-border-color",
                        "name": "at-btn-dark-border-color",
                        "type": "color",
                        "category": "at_btn-dark",
                        "value": "var(--at-primary-d-4)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-border-color--hover",
                        "name": "at-btn-dark-border-color--hover",
                        "type": "color",
                        "category": "at_btn-dark",
                        "value": "var(--at-primary-d-2)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-outline-color",
                        "name": "at-btn-dark-outline-color",
                        "type": "color",
                        "category": "at_btn-dark-outline",
                        "value": "var(--at-primary-d-4)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-outline-color--hover",
                        "name": "at-btn-dark-outline-color--hover",
                        "type": "color",
                        "category": "at_btn-dark-outline",
                        "value": "var(--at-primary-d-2)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-outline-background",
                        "name": "at-btn-dark-outline-background",
                        "type": "color",
                        "category": "at_btn-dark-outline",
                        "value": "rgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-outline-background--hover",
                        "name": "at-btn-dark-outline-background--hover",
                        "type": "color",
                        "category": "at_btn-dark-outline",
                        "value": "rgba(0,0,0,0)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-outline-border-color",
                        "name": "at-btn-dark-outline-border-color",
                        "type": "color",
                        "category": "at_btn-dark-outline",
                        "value": "var(--at-primary-d-3)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-dark-outline-border-color--hover",
                        "name": "at-btn-dark-outline-border-color--hover",
                        "type": "color",
                        "category": "at_btn-dark-outline",
                        "value": "var(--at-primary-d-1)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-small-font-size",
                        "name": "at-btn-small-font-size",
                        "type": "static",
                        "category": "at_btn-size-small",
                        "value": "var(--at-text--xs)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-small-padding-block",
                        "name": "at-btn-small-padding-block",
                        "type": "static",
                        "category": "at_btn-size-small",
                        "value": "0.4em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-small-padding-inline",
                        "name": "at-btn-small-padding-inline",
                        "type": "static",
                        "category": "at_btn-size-small",
                        "value": "1em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-medium-font-size",
                        "name": "at-btn-medium-font-size",
                        "type": "static",
                        "category": "at_btn-size-medium",
                        "value": "var(--at-text--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-medium-padding-block",
                        "name": "at-btn-medium-padding-block",
                        "type": "static",
                        "category": "at_btn-size-medium",
                        "value": "0.5em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-medium-padding-inline",
                        "name": "at-btn-medium-padding-inline",
                        "type": "static",
                        "category": "at_btn-size-medium",
                        "value": "1em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-large-font-size",
                        "name": "at-btn-large-font-size",
                        "type": "static",
                        "category": "at_btn-size-large",
                        "value": "var(--at-text--m)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-large-padding-block",
                        "name": "at-btn-large-padding-block",
                        "type": "static",
                        "category": "at_btn-size-large",
                        "value": "0.6em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-large-padding-inline",
                        "name": "at-btn-large-padding-inline",
                        "type": "static",
                        "category": "at_btn-size-large",
                        "value": "1em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-x-large-font-size",
                        "name": "at-btn-x-large-font-size",
                        "type": "static",
                        "category": "at_btn-size-extra-large",
                        "value": "var(--at-text--l)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-x-large-padding-block",
                        "name": "at-btn-x-large-padding-block",
                        "type": "static",
                        "category": "at_btn-size-extra-large",
                        "value": "0.8em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_btn-x-large-padding-inline",
                        "name": "at-btn-x-large-padding-inline",
                        "type": "static",
                        "category": "at_btn-size-extra-large",
                        "value": "1em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_link-color",
                        "name": "at-link-color",
                        "type": "color",
                        "category": "at_links",
                        "value": "var(--at-primary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_link-color--hover",
                        "name": "at-link-color--hover",
                        "type": "color",
                        "category": "at_links",
                        "value": "var(--at-primary-l-2)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_link-color--active",
                        "name": "at-link-color--active",
                        "type": "color",
                        "category": "at_links",
                        "value": "var(--at-secondary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-padding",
                        "name": "at-mark-padding",
                        "type": "static",
                        "category": "at_marks",
                        "value": "var(--at-space--xs)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-background",
                        "name": "at-mark-background",
                        "type": "color",
                        "category": "at_marks",
                        "value": "var(--at-primary)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-border-width",
                        "name": "at-mark-border-width",
                        "type": "static",
                        "category": "at_marks",
                        "value": "0.1em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-border-color",
                        "name": "at-mark-border-color",
                        "type": "color",
                        "category": "at_marks",
                        "value": "var(--at-black-t-5)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-border-radius",
                        "name": "at-mark-border-radius",
                        "type": "static",
                        "category": "at_marks",
                        "value": "var(--at-radius--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-shadow",
                        "name": "at-mark-shadow",
                        "type": "static",
                        "category": "at_marks",
                        "value": "var(--at-shadow--m)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-color",
                        "name": "at-mark-color",
                        "type": "color",
                        "category": "at_marks",
                        "value": "var(--at-primary-l-5)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-text-shadow",
                        "name": "at-mark-text-shadow",
                        "type": "static",
                        "category": "at_marks",
                        "value": "var(--at-shadow--s)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-font-size",
                        "name": "at-mark-font-size",
                        "type": "static",
                        "category": "at_marks",
                        "value": "1em",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-font-weight",
                        "name": "at-mark-font-weight",
                        "type": "static",
                        "category": "at_marks",
                        "value": "inherit",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-text-transform",
                        "name": "at-mark-text-transform",
                        "type": "static",
                        "category": "at_marks",
                        "value": "none",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-letter-spacing",
                        "name": "at-mark-letter-spacing",
                        "type": "static",
                        "category": "at_marks",
                        "value": "1",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-line-height",
                        "name": "at-mark-line-height",
                        "type": "static",
                        "category": "at_marks",
                        "value": "1",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-transform",
                        "name": "at-mark-transform",
                        "type": "static",
                        "category": "at_marks",
                        "value": "rotate(1deg)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-background-transform",
                        "name": "at-mark-background-transform",
                        "type": "static",
                        "category": "at_marks",
                        "value": "skewx(5deg);",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-inset-block",
                        "name": "at-mark-inset-block",
                        "type": "static",
                        "category": "at_marks",
                        "value": "0",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_mark-inset-inline",
                        "name": "at-mark-inset-inline",
                        "type": "static",
                        "category": "at_marks",
                        "value": "0",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_border-width",
                        "name": "at-border-width",
                        "type": "static",
                        "category": "at_border",
                        "value": "1px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_border-type",
                        "name": "at-border-type",
                        "type": "static",
                        "category": "at_border",
                        "value": "solid",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_border-color",
                        "name": "at-border-color",
                        "type": "color",
                        "category": "at_border",
                        "value": "var(--at-black-t-5)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_border--standard",
                        "name": "at-border--standard",
                        "type": "static",
                        "category": "at_border",
                        "value": "var(--at-border-width) var(--at-border-type) var(--at-border-color)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_radius--2xs",
                        "scaleId": "gzlwpp",
                        "suffix": "2xs",
                        "name": "at-radius--2xs",
                        "step": -2,
                        "multiplier": 0.382,
                        "value": "calc(var(--at-radius--s) * 0.382)",
                        "type": "scale",
                        "category": "at_border",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_radius--xs",
                        "scaleId": "gzlwpp",
                        "suffix": "xs",
                        "name": "at-radius--xs",
                        "step": -1,
                        "multiplier": 0.618,
                        "value": "calc(var(--at-radius--s) * 0.618)",
                        "type": "scale",
                        "category": "at_border",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_radius--s",
                        "scaleId": "gzlwpp",
                        "label": "at-radius-",
                        "suffix": "s",
                        "name": "at-radius--s",
                        "step": 0,
                        "smallSteps": "2",
                        "largeSteps": "2",
                        "multiplier": 1,
                        "type": "scale",
                        "scaleType": 1.618,
                        "value": "clamp(calc(1rem * (5 / var(--base-font))), calc(1rem * ((((-1 * var(--min-viewport)) / var(--base-font)) * ((10 - 5) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font))) + (5 / var(--base-font)))) + (((10 - 5) / var(--base-font)) / ((var(--max-viewport) - var(--min-viewport)) / var(--base-font)) * 100) * var(--clamp-unit), calc(1rem * (10 / var(--base-font))));",
                        "base": true,
                        "min": "5",
                        "max": "10",
                        "category": "at_border",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_radius--m",
                        "scaleId": "gzlwpp",
                        "suffix": "m",
                        "name": "at-radius--m",
                        "step": 1,
                        "multiplier": 1.618,
                        "value": "calc(var(--at-radius--s) * 1.618)",
                        "type": "scale",
                        "category": "at_border",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_radius-full",
                        "name": "at-radius-full",
                        "type": "static",
                        "category": "at_border",
                        "value": "999rem",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_shadow--s",
                        "name": "at-shadow--s",
                        "type": "static",
                        "category": "at_box-shadow",
                        "value": "rgba(0, 0, 0, 0.1) 0px 1px 3px 0px, rgba(0, 0, 0, 0.06) 0px 1px 2px 0px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_shadow--m",
                        "name": "at-shadow--m",
                        "type": "static",
                        "category": "at_box-shadow",
                        "value": "rgba(0, 0, 0, 0.1) 0px 4px 6px -1px, rgba(0, 0, 0, 0.06) 0px 2px 4px -1px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_shadow--l",
                        "name": "at-shadow--l",
                        "type": "static",
                        "category": "at_box-shadow",
                        "value": "rgba(0, 0, 0, 0.1) 0px 10px 15px -3px, rgba(0, 0, 0, 0.05) 0px 4px 6px -2px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_shadow--xl",
                        "name": "at-shadow--xl",
                        "type": "static",
                        "category": "at_box-shadow",
                        "value": "rgba(0, 0, 0, 0.1) 0px 20px 25px -5px, rgba(0, 0, 0, 0.04) 0px 10px 10px -5px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_shadow--2xl",
                        "name": "at-shadow--2xl",
                        "type": "static",
                        "category": "at_box-shadow",
                        "value": "rgba(0, 0, 0, 0.25) 0px 25px 50px -12px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_duration--fast",
                        "name": "at-duration--fast",
                        "type": "static",
                        "category": "at_filter",
                        "value": "0.2s",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_duration--medium",
                        "name": "at-duration--medium",
                        "type": "static",
                        "category": "at_filter",
                        "value": "0.5s",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_duration--slow",
                        "name": "at-duration--slow",
                        "type": "static",
                        "category": "at_filter",
                        "value": "1.5s",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_distance--s",
                        "name": "at-distance--s",
                        "type": "static",
                        "category": "at_filter",
                        "value": "4px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_distance--m",
                        "name": "at-distance--m",
                        "type": "static",
                        "category": "at_filter",
                        "value": "15px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_distance--l",
                        "name": "at-distance--l",
                        "type": "static",
                        "category": "at_filter",
                        "value": "40px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_focus-outline-color",
                        "name": "at-focus-outline-color",
                        "type": "static",
                        "category": "at_a11y",
                        "value": "var(--at-neutral)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_focus-outline-width",
                        "name": "at-focus-outline-width",
                        "type": "static",
                        "category": "at_a11y",
                        "value": "3px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_focus-outline-offset",
                        "name": "at-focus-outline-offset",
                        "type": "static",
                        "category": "at_a11y",
                        "value": "3px",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_svg--arrow",
                        "name": "at-svg--arrow",
                        "type": "static",
                        "category": "at_svg",
                        "value": "url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0IiBjb2xvcj0iIzAwMDAwMCIgZmlsbD0ibm9uZSI+CiAgICA8cGF0aCBkPSJNOS4wMDAwNSA2TDE1IDEyTDkgMTgiIHN0cm9rZT0iY3VycmVudENvbG9yIiBzdHJva2Utd2lkdGg9IjEuNSIgc3Ryb2tlLW1pdGVybGltaXQ9IjE2IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIC8+Cjwvc3ZnPg==)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_svg--check",
                        "name": "at-svg--check",
                        "type": "static",
                        "category": "at_svg",
                        "value": "url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0IiBjb2xvcj0iIzAwMDAwMCIgZmlsbD0ibm9uZSI+CiAgICA8cGF0aCBkPSJNNC4yNSAxMy41TDguNzUgMThMMTkuNzUgNiIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIC8+Cjwvc3ZnPg==)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_svg--cross",
                        "name": "at-svg--cross",
                        "type": "static",
                        "category": "at_svg",
                        "value": "url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0IiBjb2xvcj0iIzAwMDAwMCIgZmlsbD0ibm9uZSI+CiAgICA8cGF0aCBkPSJNNS4wMDA0OSA0Ljk5OTg4TDE5LjAwMDUgMTguOTk5OSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIC8+CiAgICA8cGF0aCBkPSJNMTkuMDAwNSA0Ljk5OTg4TDUuMDAwNDkgMTguOTk5OSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIC8+Cjwvc3ZnPg==)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_svg--heart",
                        "name": "at-svg--heart",
                        "type": "static",
                        "category": "at_svg",
                        "value": "url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0IiBjb2xvcj0iIzAwMDAwMCIgZmlsbD0ibm9uZSI+CiAgICA8cGF0aCBkPSJNMTkuNDYyNiAzLjk5NDE1QzE2Ljc4MDkgMi4zNDkyMyAxNC40NDA0IDMuMDEyMTEgMTMuMDM0NCA0LjA2ODAxQzEyLjQ1NzggNC41MDA5NiAxMi4xNjk2IDQuNzE3NDMgMTIgNC43MTc0M0MxMS44MzA0IDQuNzE3NDMgMTEuNTQyMiA0LjUwMDk2IDEwLjk2NTYgNC4wNjgwMUM5LjU1OTYyIDMuMDEyMTEgNy4yMTkwOSAyLjM0OTIzIDQuNTM3NDQgMy45OTQxNUMxLjAxODA3IDYuMTUyOTQgMC4yMjE3MjEgMTMuMjc0OSA4LjMzOTUzIDE5LjI4MzRDOS44ODU3MiAyMC40Mjc4IDEwLjY1ODggMjEgMTIgMjFDMTMuMzQxMiAyMSAxNC4xMTQzIDIwLjQyNzggMTUuNjYwNSAxOS4yODM0QzIzLjc3ODMgMTMuMjc0OSAyMi45ODE5IDYuMTUyOTQgMTkuNDYyNiAzLjk5NDE1WiIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWNhcD0icm91bmQiIC8+Cjwvc3ZnPg==)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_svg--delete",
                        "name": "at-svg--delete",
                        "type": "static",
                        "category": "at_svg",
                        "value": "url(data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHZpZXdCb3g9IjAgMCAyNCAyNCIgd2lkdGg9IjI0IiBoZWlnaHQ9IjI0IiBjb2xvcj0iIzAwMDAwMCIgZmlsbD0ibm9uZSI+CiAgICA8cGF0aCBkPSJNMTkuNSA1LjVMMTguNSAyMkg1LjVMNC41IDUuNSIgc3Ryb2tlPSJjdXJyZW50Q29sb3IiIHN0cm9rZS13aWR0aD0iMS41IiBzdHJva2UtbGluZWpvaW49InJvdW5kIiAvPgogICAgPHBhdGggZD0iTTIgNS41SDhNMjIgNS41SDE2TTE2IDUuNUwxNC41IDJIOS41TDggNS41TTE2IDUuNUg4IiBzdHJva2U9ImN1cnJlbnRDb2xvciIgc3Ryb2tlLXdpZHRoPSIxLjUiIHN0cm9rZS1saW5lam9pbj0icm91bmQiIC8+Cjwvc3ZnPg==)",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    }
                ]',
            "global_classes_cat" => '
                [
                    {
                        "id": "at_colorset",
                        "name": "Color Set",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_focus",
                        "name": "Focus",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_ul",
                        "name": "Unordered List",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_line-clamp",
                        "name": "Line Clamp",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_marks",
                        "name": "Marks",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "at_accessibility",
                        "name": "Accessibility",
                        "at_framework": true,
                        "at_version": "1.0.0"
                    }
                ]',
            "global_classes" => '
            [
    {
        "id":"at_colorset",
        "name":"at-colorset",
        "settings":{
            "_cssCustom":"/*\\nCOLOR SETS\\n*/\\n\\n/* Do not use :where on this rule or it will get overridden by .at-section--alt-odd and .at-section--alt-even */\\n[class*=\\"colorset--\\"] {\\n  color: var(--text-color);\\n  background: var(--background);\\n}\\n\\n:where([class*=\\"colorset--\\"] h1, [class*=\\"colorset--\\"] h2, [class*=\\"colorset--\\"] h3, [class*=\\"colorset--\\"] h4) {\\n  color: var(--heading-color);\\n}\\n\\n:where([class*=\\"colorset--\\"]) :is(.brxe-text-link, .brxe-text a, .brxe-text-basic a) {\\n  color: var(--link-color, var(--at-link-color));\\n}\\n\\n:where([class*=\\"colorset--\\"]) .brxe-text-link:is(:hover, :focus-visible) {\\n  color: var(--link-color--hover, var(--at-link-color--hover));\\n}\\n\\n:where([class*=\\"colorset--\\"]) .brxe-text-link:active {\\n  color: var(--link-color--active, var(--at-link-color--active));\\n}\\n\\n:where([class*=\\"colorset--\\"] [class*=\\"header-wrapper\\"]){\\n  color: var(--header-wrapper-color);\\n  background: var(--header-wrapper-background);\\n}\\n:where([class*=\\"colorset--\\"] [class*=\\"body-wrapper\\"]){\\n  color: var(--body-wrapper-color);\\n  background: var(--body-wrapper-background);\\n}\\n:where([class*=\\"colorset--\\"] [class*=\\"footer-wrapper\\"]){\\n  color: var(--footer-wrapper-color);\\n  background: var(--footer-wrapper-background);\\n}\\n:where([class*=\\"colorset--\\"] [class*=\\"media-wrapper\\"]){\\n  color: var(--media-wrapper-color);\\n  background: var(--media-wrapper-background);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category":"at_colorset"
    },
    {
        "id": "at_colorset--neutral",
        "name": "at-colorset--neutral",
        "settings": {
            "_cssCustom": ".at-colorset--neutral {\\n  --text-color: var(--at-neutral-l-5);\\n  --background: var(--at-neutral);\\n  --heading-color: var(--at-neutral-l-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-neutral-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-d-1",
        "name": "at-colorset--neutral-d-1",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-d-1 {\\n  --text-color: var(--at-neutral-l-5);\\n  --background: var(--at-neutral-d-1);\\n  --heading-color: var(--at-neutral-l-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-neutral-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-d-2",
        "name": "at-colorset--neutral-d-2",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-d-2 {\\n  --text-color: var(--at-neutral-l-5);\\n  --background: var(--at-neutral-d-2);\\n  --heading-color: var(--at-neutral-l-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-neutral-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-d-3",
        "name": "at-colorset--neutral-d-3",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-d-3 {\\n  --text-color: var(--at-neutral-l-5);\\n  --background: var(--at-neutral-d-3);\\n  --heading-color: var(--at-neutral-l-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-neutral-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset",
        "modified": 1744116507,
        "user_id": 1
    },
    {
        "id": "at_colorset--neutral-d-4",
        "name": "at-colorset--neutral-d-4",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-d-4 {\\n  --text-color: var(--at-neutral-l-5);\\n  --background: var(--at-neutral-d-4);\\n  --heading-color: var(--at-neutral-l-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-neutral-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-d-5",
        "name": "at-colorset--neutral-d-5",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-d-5 {\\n  --text-color: var(--at-neutral-l-5);\\n  --background: var(--at-neutral-d-5);\\n  --heading-color: var(--at-neutral-l-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-neutral-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-d-6",
        "name": "at-colorset--neutral-d-6",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-d-6 {\\n  --text-color: var(--at-neutral-l-5);\\n  --background: var(--at-neutral-d-6);\\n  --heading-color: var(--at-neutral-l-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-neutral-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-l-1",
        "name": "at-colorset--neutral-l-1",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-l-1 {\\n  --text-color: var(--at-neutral-d-5);\\n  --background: var(--at-neutral-l-1);\\n  --heading-color: var(--at-neutral-d-6);\\n  \\n  --link-color: var(--at-primary);\\n  --link-color--hover: var(--at-primary-d-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-neutral-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-l-2",
        "name": "at-colorset--neutral-l-2",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-l-2 {\\n  --text-color: var(--at-neutral-d-5);\\n  --background: var(--at-neutral-l-2);\\n  --heading-color: var(--at-neutral-d-6);\\n  \\n  --link-color: var(--at-primary-d-2);\\n  --link-color--hover: var(--at-primary-d-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-neutral-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-l-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-l-3",
        "name": "at-colorset--neutral-l-3",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-l-3 {\\n  --text-color: var(--at-neutral-d-5);\\n  --background: var(--at-neutral-l-3);\\n  --heading-color: var(--at-neutral-d-6);\\n  \\n  --link-color: var(--at-primary-d-2);\\n  --link-color--hover: var(--at-primary-d-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-neutral-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5); \\n\\n  --media-wrapper-color: var(--at-neutral-d-6);\\n   --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-l-4",
        "name": "at-colorset--neutral-l-4",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-l-4 {\\n  --text-color: var(--at-neutral-d-5);\\n  --background: var(--at-neutral-l-4);\\n  --heading-color: var(--at-neutral-d-6);\\n  \\n  --link-color: var(--at-primary-d-2);\\n  --link-color--hover: var(--at-primary-d-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-neutral-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-d-6);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-l-5",
        "name": "at-colorset--neutral-l-5",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-l-5 {\\n  --text-color: var(--at-neutral-d-5);\\n  --background: var(--at-neutral-l-5);\\n  --heading-color: var(--at-neutral-d-6);\\n  \\n  --link-color: var(--at-primary-d-2);\\n  --link-color--hover: var(--at-primary-d-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-neutral-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5); \\n\\n  --media-wrapper-color: var(--at-neutral-d-6);\\n   --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--neutral-l-6",
        "name": "at-colorset--neutral-l-6",
        "settings": {
            "_cssCustom": ".at-colorset--neutral-l-6 {\\n  --text-color: var(--at-neutral-d-5);\\n  --background: var(--at-neutral-l-6);\\n  --heading-color: var(--at-neutral-d-6);\\n\\n  --link-color: var(--at-primary-d-2);\\n  --link-color--hover: var(--at-primary-d-6);\\n  --link-color--active: var(--at-primary-l-6);\\n\\n  --header-wrapper-color: var(--at-neutral-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-neutral-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-neutral-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-neutral-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary",
        "name": "at-colorset--primary",
        "settings": {
            "_cssCustom": ".at-colorset--primary {\\n  --text-color: var(--at-primary-l-5);\\n  --background: var(--at-primary);\\n  --heading-color: var(--at-primary-l-6);\\n  \\n  --link-color:  var(--at-primary-d-5);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-d-1",
        "name": "at-colorset--primary-d-1",
        "settings": {
            "_cssCustom": ".at-colorset--primary-d-1 {\\n  --text-color: var(--at-primary-l-5);\\n  --background: var(--at-primary-d-1);\\n  --heading-color: var(--at-primary-l-6);\\n  \\n  --link-color:  var(--at-primary-d-5);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-d-2",
        "name": "at-colorset--primary-d-2",
        "settings": {
            "_cssCustom": ".at-colorset--primary-d-2 {\\n  --text-color: var(--at-primary-l-5);\\n  --background: var(--at-primary-d-2);\\n  --heading-color: var(--at-primary-l-6);\\n  \\n  --link-color:  var(--at-primary-d-5);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-d-3",
        "name": "at-colorset--primary-d-3",
        "settings": {
            "_cssCustom": ".at-colorset--primary-d-3 {\\n  --text-color: var(--at-primary-l-5);\\n  --background: var(--at-primary-d-3);\\n  --heading-color: var(--at-primary-l-6);\\n  \\n  --link-color:  var(--at-primary-l-4);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-d-4",
        "name": "at-colorset--primary-d-4",
        "settings": {
            "_cssCustom": ".at-colorset--primary-d-4 {\\n  --text-color: var(--at-primary-l-5);\\n  --background: var(--at-primary-d-4);\\n  --heading-color: var(--at-primary-l-6);\\n  \\n  --link-color:  var(--at-primary-l-4);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-d-5",
        "name": "at-colorset--primary-d-5",
        "settings": {
            "_cssCustom": ".at-colorset--primary-d-5 {\\n  --text-color: var(--at-primary-l-5);\\n  --background: var(--at-primary-d-5);\\n  --heading-color: var(--at-primary-l-6);\\n  \\n  --link-color:  var(--at-primary-l-4);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-d-6",
        "name": "at-colorset--primary-d-6",
        "settings": {
            "_cssCustom": ".at-colorset--primary-d-6 {\\n  --text-color: var(--at-primary-l-5);\\n  --background: var(--at-primary-d-6);\\n  --heading-color: var(--at-primary-l-6);\\n  \\n  --link-color:  var(--at-primary-l-4);\\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n    --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-l-1",
        "name": "at-colorset--primary-l-1",
        "settings": {
            "_cssCustom": ".at-colorset--primary-l-1 {\\n  --text-color: var(--at-primary-d-5);\\n  --background: var(--at-primary-l-1);\\n  --heading-color: var(--at-primary-d-6);\\n  \\n  --link-color:  var(--at-primary-d-2); \\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-primary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-l-2",
        "name": "at-colorset--primary-l-2",
        "settings": {
            "_cssCustom": ".at-colorset--primary-l-2 {\\n  --text-color: var(--at-primary-d-5);\\n  --background: var(--at-primary-l-2);\\n   --heading-color: var(--at-primary-d-6);\\n  --link-color:  var(--at-primary-d-2); \\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-primary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-l-3",
        "name": "at-colorset--primary-l-3",
        "settings": {
            "_cssCustom": ".at-colorset--primary-l-3 {\\n  --text-color: var(--at-primary-d-5);\\n  --background: var(--at-primary-l-3);\\n  --heading-color: var(--at-primary-d-6);\\n  \\n  --link-color:  var(--at-primary-d-2); \\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  \\n  --header-wrapper-color: var(--at-primary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-l-4",
        "name": "at-colorset--primary-l-4",
        "settings": {
            "_cssCustom": ".at-colorset--primary-l-4 {\\n  --text-color: var(--at-primary-d-5);\\n  --background: var(--at-primary-l-4);\\n  --heading-color: var(--at-primary-d-6);\\n  \\n  --link-color:  var(--at-primary-d-2); \\n  --link-color--hover: var(--at-primary-l-6);\\n  --link-color--active: var(--at-primary-l-6);\\n  \\n  --header-wrapper-color: var(--at-primary-l-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n \\n  --header-wrapper-color: var(--at-primary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-l-5",
        "name": "at-colorset--primary-l-5",
        "settings": {
            "_cssCustom": ".at-colorset--primary-l-5 {\\n  --text-color: var(--at-primary-d-5);\\n  --background: var(--at-primary-l-5);\\n  --heading-color: var(--at-primary-d-6);\\n  \\n  --link-color:  var(--at-primary-d-2); \\n  --link-color--hover: var(--at-primary-d-6); \\n  --link-color--active: var(--at-primary-d-6);\\n  \\n  --header-wrapper-color: var(--at-primary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--primary-l-6",
        "name": "at-colorset--primary-l-6",
        "settings": {
            "_cssCustom": ".at-colorset--primary-l-6 {\\n  --text-color: var(--at-primary-d-5);\\n  --background: var(--at-primary-l-5);\\n  --heading-color: var(--at-primary-d-6);\\n  \\n  --link-color:  var(--at-primary-d-2); \\n  --link-color--hover: var(--at-primary-d-6); \\n  --link-color--active: var(--at-primary-d-6);\\n  \\n  --header-wrapper-color: var(--at-primary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-primary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-primary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-primary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary",
        "name": "at-colorset--secondary",
        "settings": {
            "_cssCustom": ".at-colorset--secondary {\\n  --text-color: var(--at-secondary-l-5);\\n  --background: var(--at-secondary);\\n  --heading-color: var(--at-secondary-l-6);\\n  \\n  --link-color:  var(--at-secondary-d-5);\\n  --link-color--hover: var(--at-secondary-l-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-d-1",
        "name": "at-colorset--secondary-d-1",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-d-1 {\\n  --text-color: var(--at-secondary-l-5);\\n  --background: var(--at-secondary-d-1);\\n  --heading-color: var(--at-secondary-l-6);\\n  \\n  --link-color:  var(--at-secondary-d-5);\\n  --link-color--hover: var(--at-secondary-l-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-d-2",
        "name": "at-colorset--secondary-d-2",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-d-2 {\\n  --text-color: var(--at-secondary-l-5);\\n  --background: var(--at-secondary-d-2);\\n  --heading-color: var(--at-secondary-l-6);\\n  \\n  --link-color:  var(--at-secondary-d-5);\\n  --link-color--hover: var(--at-secondary-l-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-d-3",
        "name": "at-colorset--secondary-d-3",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-d-3 {\\n  --text-color: var(--at-secondary-l-5);\\n  --background: var(--at-secondary-d-3);\\n  --heading-color: var(--at-secondary-l-6);\\n  \\n  --link-color:  var(--at-secondary-l-4);\\n  --link-color--hover: var(--at-secondary-l-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-d-4",
        "name": "at-colorset--secondary-d-4",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-d-4 {\\n  --text-color: var(--at-secondary-l-5);\\n  --background: var(--at-secondary-d-4);\\n  --heading-color: var(--at-secondary-l-6);\\n  \\n    \\n  --link-color:  var(--at-secondary-l-4);\\n  --link-color--hover: var(--at-secondary-l-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-d-5",
        "name": "at-colorset--secondary-d-5",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-d-5 {\\n  --text-color: var(--at-secondary-l-5);\\n  --background: var(--at-secondary-d-5);\\n  --heading-color: var(--at-secondary-l-6);\\n  \\n    \\n  --link-color:  var(--at-secondary-l-4);\\n  --link-color--hover: var(--at-secondary-l-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-d-6",
        "name": "at-colorset--secondary-d-6",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-d-6 {\\n  --text-color: var(--at-secondary-l-5);\\n  --background: var(--at-secondary-d-6);\\n  --heading-color: var(--at-secondary-l-6);\\n  \\n    \\n  --link-color:  var(--at-secondary-l-4);\\n  --link-color--hover: var(--at-secondary-l-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-l-6);\\n  --header-wrapper-background: var(--at-white-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-l-5);\\n  --body-wrapper-background: var(--at-white-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-l-6);\\n  --footer-wrapper-background: var(--at-white-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-l-6);\\n  --media-wrapper-background: var(--at-white-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-l-1",
        "name": "at-colorset--secondary-l-1",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-l-1 {\\n  --text-color: var(--at-secondary-d-5);\\n  --background: var(--at-secondary-l-1);\\n  --heading-color: var(--at-secondary-d-6);\\n  \\n    \\n  --link-color:  var(--at-secondary-d-4);\\n  --link-color--hover: var(--at-secondary-d-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-l-2",
        "name": "at-colorset--secondary-l-2",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-l-2 {\\n  --text-color: var(--at-secondary-d-5);\\n  --background: var(--at-secondary-l-2);\\n  --heading-color: var(--at-secondary-d-6);\\n  \\n    \\n  --link-color:  var(--at-secondary-d-4);\\n  --link-color--hover: var(--at-secondary-d-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-l-3",
        "name": "at-colorset--secondary-l-3",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-l-3 {\\n  --text-color: var(--at-secondary-d-5);\\n  --background: var(--at-secondary-l-3);\\n  --heading-color: var(--at-secondary-d-6);\\n  \\n  --link-color:  var(--at-secondary-d-1);\\n  --link-color--hover: var(--at-secondary-d-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-l-4",
        "name": "at-colorset--secondary-l-4",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-l-4 {\\n  --text-color: var(--at-secondary-d-5);\\n  --background: var(--at-secondary-l-4);\\n  --heading-color: var(--at-secondary-d-6);\\n  \\n  --link-color:  var(--at-secondary-d-1);\\n  --link-color--hover: var(--at-secondary-d-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-l-5",
        "name": "at-colorset--secondary-l-5",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-l-5 {\\n  --text-color: var(--at-secondary-d-5);\\n  --background: var(--at-secondary-l-5);\\n  --heading-color: var(--at-secondary-d-6);\\n  \\n  --link-color:  var(--at-secondary-d-1);\\n  --link-color--hover: var(--at-secondary-d-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n  --media-wrapper-color: var(--at-secondary-d-6);\\n  --media-wrapper-background: var(--at-black-t-5);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_colorset--secondary-l-6",
        "name": "at-colorset--secondary-l-6",
        "settings": {
            "_cssCustom": ".at-colorset--secondary-l-6 {\\n    --text-color: var(--at-secondary-d-5);\\n  --background: var(--at-secondary-l-6);\\n  --heading-color: var(--at-secondary-d-6);\\n  \\n  --link-color:  var(--at-secondary-d-1);\\n  --link-color--hover: var(--at-secondary-d-6);\\n  --link-color--active: var(--at-secondary-l-6);\\n  \\n  --header-wrapper-color: var(--at-secondary-d-6);\\n  --header-wrapper-background: var(--at-black-t-5);\\n\\n  --body-wrapper-color: var(--at-secondary-d-5);\\n  --body-wrapper-background: var(--at-black-t-5);\\n\\n  --footer-wrapper-color: var(--at-secondary-d-6);\\n  --footer-wrapper-background: var(--at-black-t-5);\\n\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_colorset"
    },
    {
        "id": "at_focus--dark",
        "name": "at-focus--dark",
        "settings": {
            "_cssCustom": ".at-focus--dark{\n  --at-focus-outline-color: var(--at-black);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_focus"
    },
    {
        "id": "at_focus--light",
        "name": "at-focus--light",
        "settings": {
            "_cssCustom": ".at-focus--light{\n  --at-focus-outline-color: var(--at-white);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_focus"
    },
    {
        "id": "at_focus--primary",
        "name": "at-focus--primary",
        "settings": {
            "_cssCustom": ".at-focus--primary{\n  --at-focus-outline-color: var(--at-primary);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_focus"
    },
    {
        "id": "at_focus--secondary",
        "name": "at-focus--secondary",
        "settings": {
            "_cssCustom": ".at-focus--secondary{\n  --at-focus-outline-color: var(--at-secondary);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_focus"
    },
    {
        "id": "at_focus--neutral",
        "name": "at-focus--neutral",
        "settings": {
            "_cssCustom": ".at-focus--neutral{\n  --at-focus-outline-color: var(--at-neutral);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_focus"
    },
    {
        "id": "at_focus-here",
        "name": "at-focus-here",
        "settings": {
            "_cssCustom": "body.bricks-is-frontend .at-focus-here :focus-visible{\n\toutline: none !important;\n}\n\n.at-focus-here:has(:focus-visible){\n  outline-color: var(--at-focus-outline-colo);\n  outline-width: var(--at-focus-outline-width);\n  outline-offset: vvar(--at-focus-outline-offset);\n  outline-style: solid;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_focus"
    },
    {
        "id":"at_line-clamp",
        "name":"at-line-clamp",
        "settings":{
            "_cssCustom":"/*\\nLine Clamp \\n*/\\n[class*=\\"line-clamp--\\"]{\\n  line-clamp: var(--lines);\\n  /* Native support in some modern browsers */\\n  overflow: hidden;\\n  display: -webkit-box;\\n  -webkit-box-orient: vertical;\\n  -webkit-line-clamp: var(--lines);\\n}\\n\\n/* fix IOS issue with non inline elements */\\n[class*=\\"line-clamp--\\"]>p {\\n  display: inline;\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category":"at_line-clamp"
    },
    {
        "id": "at_line-clamp--1",
        "name": "at-line-clamp--1",
        "settings": {
            "_cssCustom": ".at-line-clamp--1 {\n  --lines: 1;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_line-clamp"
    },
    {
        "id": "at_line-clamp--2",
        "name": "at-line-clamp--2",
        "settings": {
            "_cssCustom": ".at-line-clamp--2 {\n  --lines: 2;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_line-clamp"
    },
    {
        "id": "at_line-clamp--3",
        "name": "at-line-clamp--3",
        "settings": {
            "_cssCustom": ".at-line-clamp--3 {\n  --lines: 3;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_line-clamp"
    },
    {
        "id": "at_line-clamp--4",
        "name": "at-line-clamp--4",
        "settings": {
            "_cssCustom": ".at-line-clamp--4 {\n  --lines: 4;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_line-clamp"
    },
    {
        "id": "at_line-clamp--5",
        "name": "at-line-clamp--5",
        "settings": {
            "_cssCustom": ".at-line-clamp--5 {\n  --lines: 5;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_line-clamp"
    },
    {
        "id": "at_mark",
        "name": "at-mark",
        "settings": {
            "_cssCustom": "mark[class*=mark--],\\n[class*=mark--] mark {\\n  --_color: var(--color, var(--at-mark-color));\\n  --_line-height: var(--line-height, var(--at-mark-line-height));\\n  --_padding: var(--padding, var(--at-mark-padding));\\n  --_text-shadow: var(--text-shadow, var(--at-mark-text-shadow));\\n  --_font-size: var(--font-size, var(--at-mark-font-size));\\n  --_font-weight: var(--font-weight, var(--at-mark-font-weight));\\n  --_text-transform: var(--text-transform, var(--at-mark-text-transform));\\n  --_letter-spacing: var(--letter-spacing, var(--at-mark-letter-spacing));\\n  --_transform: var(--transform, var(--at-mark-transform));\\n\\n  --_background: var(--background, var(--at-mark-background));\\n  --_box-shadow: var(--background, var(--at-mark-shadow));\\n  --_border: var(--border, var(--at-mark-border-width) solid var(--at-mark-border-color));\\n  --_border-radius: var(--border-radius, var(--at-mark-border-radius));\\n  --_background-transform: var(--background-transform, var(--at-mark-background-transform));\\n  --_inset-block: var(--inset-block, var(--at-mark-inset-block));\\n  --_inset-inline: var(--inset-inline, var(--at-mark-inset-inline));\\n}\\n\\nmark.at-mark,\\n.at-mark mark {\\n  display: inline-flex;\\n  position: relative;\\n  isolation: isolate;\\n  color: var(--_color);\\n  line-height: var(--_line-height);\\n  background: transparent;\\n  padding: var(--_padding);\\n  text-shadow: var(--_text-shadow);\\n  font-size: var(--_font-size);\\n  font-weight: var(--at-mark-font-weight);\\n  text-transform: var(--_text-transform);\\n  letter-spacing: var(--_letter-spacing);\\n  transform: var(--_transform);\\n}\\n\\nmark.at-mark::before,\\n.at-mark mark::before {\\n  position: absolute;\\n  content: \'\';\\n  inset-block: var(--_inset-block);\\n  inset-inline: var(--_inset-inline);\\n  background: var(--_background);\\n  box-shadow: var(--_box-shadow);\\n  border: var(--_border);\\n  border-radius: var(--_border-radius);\\n  z-index: -1;\\n  transform: var(--_background-transform);\\n}\\n\\n/* Marke modifiers here, so they can be used in HTML whthout Bricks outputting the rules */\\n.at-mark--primary {\\n    --color: var(--at-primary-l-5);\\n    --background: var(--at-primary);\\n}\\n\\n.at-mark--secondary {\\n    --color: var(--at-secondary-l-5);\\n    --background: var(--at-secondary);\\n}\\n.at-mark--dark {\\n    --color: var(--at-neutral-l-5);\\n    --background: var(--at-neutral-d-5);\\n}\\n.at-mark--light {\\n    --color: var(--at-neutral-d-5);\\n    --background: var(--at-neutral-l-6);\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_marks"
    },
    {
        "id": "at_mark--dark",
        "name": "at-mark--dark",
        "settings": {
            "_cssCustom": "/* See <at-mark> Global Class */",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_marks"
    },
    {
        "id": "at_mark--light",
        "name": "at-mark--light",
        "settings": {
            "_cssCustom": "/* See <at-mark> Global Class */",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_marks"
    },
    {
        "id": "at_mark--primary",
        "name": "at-mark--primary",
        "settings": {
            "_cssCustom": "/* See <at-mark> Global Class */",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_marks"
    },
    {
        "id": "at_mark--secondary",
        "name": "at-mark--secondary",
        "settings": {
            "_cssCustom": "/* See <at-mark> Global Class */",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_marks"
    },
    {
        "id": "at_ul-padding--0",
        "name": "at-ul-padding--0",
        "settings": {
            "_cssCustom": ".at-ul-padding--0 ul{\n  padding: 0;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-padding--s",
        "name": "at-ul-padding--s",
        "settings": {
            "_cssCustom": ".at-ul-padding--s ul{\n  padding-inline-start: var(--at-space--s);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id":"at_ul-svg-icon",
        "name":"at-ul-svg-icon",
        "settings":{
            "_cssCustom":"/* \\nReplace UL\'s in text elements with SVG Icons\\nNote: This uses a Grid layout. It will not work for item content with additional html elements.\\n*/\\n[class*=\\"ul-svg-icon--\\"] {\\n  --_item-gap: var(--item-gap, 0.25em);\\n  --_font-size: var(--font-size, var(--at-text--s));\\n  --_icon-gap: var(--gap, 0.5em);\\n  --_image-mask: var(--image-mask, var(--at-svg--arrow));\\n  --_icon-color: var(--icon-color, var(--at-primary));\\n  --_icon-offset: var(--icon-offset, 0.3em);\\n  --_icon-size: var(--icon-size, 1.2em);\\n}\\n\\n[class*=\\"ul-svg-icon--\\"] ul {\\n  list-style-type: none;\\n  display: flex;\\n  flex-direction: column;\\n  gap: var(--_item-gap);\\n  font-size: var(--_font-size);\\n}\\n\\n[class*=\\"ul-svg-icon--\\"] ul > li {\\n  display: grid;\\n  grid-template-columns: auto 1fr;\\n  gap: var(--_icon-gap);\\n}\\n\\n[class*=\\"ul-svg-icon--\\"] ul > li::before {\\n  content: \'\';\\n  width: var(--_icon-size);\\n  height: var(--_icon-size);\\n  background-color: var(--_icon-color);\\n  margin-block-start: var(--_icon-offset);\\n  object-fit: cover;\\n  mask-image: var(--_image-mask);\\n  -webkit-mask-size: cover;\\n  mask-size: cover;\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category":"at_ul"
    },
    {
        "id": "at_ul-svg-icon--black",
        "name": "at-ul-svg-icon--black",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--black {\n  --icon-color: var(--at-black);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-svg-icon--check",
        "name": "at-ul-svg-icon--check",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--check{\n\t--image-mask: var(--at-svg--check);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-svg-icon--cross",
        "name": "at-ul-svg-icon--cross",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--cross{\n  \t--image-mask: var(--at-svg--cross);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-svg-icon--dark",
        "name": "at-ul-svg-icon--dark",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--dark {\n  --icon-color: var(--at-neutral-d-5);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-svg-icon--delete",
        "name": "at-ul-svg-icon--delete",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--delete {\n  --image-mask: var(--at-svg--delete);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-svg-icon--heart",
        "name": "at-ul-svg-icon--heart",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--heart{\n  \t--image-mask: var(--at-svg--heart);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-svg-icon--light",
        "name": "at-ul-svg-icon--light",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--light {\n  --icon-color: var(--at-neutral-l-5);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_ul-svg-icon--secondary",
        "name": "at-ul-svg-icon--secondary",
        "settings": {
            "_cssCustom": ".at-ul-svg-icon--secondary {\n  --icon-color: var(--at-secondary);\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_ul"
    },
    {
        "id": "at_clickable-box",
        "name": "at-clickable-box",
        "settings": {
            "_cssCustom": ".at-clickable-box {\n\tposition: relative;\n}\n\n.at-clickable-box a{\n  position: static;\n  z-index:999;\n}\n\n.bricks-is-frontend .at-clickable-box a::before{\n  content: \'\';\n  position: absolute;\n  inset: 0;\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category": "at_accessibility"
    },
    {
        "id":"at_visually-hidden",
        "name":"at-visually-hidden",
        "settings":{
            "_cssCustom": ".at-visually-hidden {\\n\\tclip: rect(0 0 0 0);\\n  clip-path: inset(50%);\\n  height: 1px;\\n  overflow: hidden;\\n  position: absolute;\\n  white-space: nowrap;\\n  width: 1px;\\n}",
            "at_framework": true,
            "at_version": "1.0.0"
        },
        "category":"at_accessibility"
    }
]',
            "global_colors" => '
                [
                    {
                        "id": "at_framework_palette",
                        "name": "AT Framework",
                        "at_framework": true,
                        "at_version": "1.0.0",
                        "status": "enabled",
                        "prefix": "at-",
                        "defaultExpanded": true,
                        "default": "true",
                        "colors": [
                            {
                                "id": "at_primary",
                                "name": "primary",
                                "raw": "var(--at-primary)",
                                "rawValue": {
                                    "light": "hsla(182, 68%, 49%, 1)",
                                    "dark": "hsla(182, 68%, 49%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_primary-l-1",
                                    "at_primary-l-2",
                                    "at_primary-l-3",
                                    "at_primary-l-4",
                                    "at_primary-l-5",
                                    "at_primary-l-6",
                                    "at_primary-d-1",
                                    "at_primary-d-2",
                                    "at_primary-d-3",
                                    "at_primary-d-4",
                                    "at_primary-d-5",
                                    "at_primary-d-6",
                                    "at_primary-t-1",
                                    "at_primary-t-2",
                                    "at_primary-t-3",
                                    "at_primary-t-4",
                                    "at_primary-t-5",
                                    "at_primary-t-6"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-1",
                                "name": "primary-l-1",
                                "raw": "var(--at-primary-l-1)",
                                "rawValue": {
                                    "light": "hsla(182.1,65.3%,57.06%,1)",
                                    "dark": "hsla(182.1,65.3%,42.94%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-2",
                                "name": "primary-l-2",
                                "raw": "var(--at-primary-l-2)",
                                "rawValue": {
                                    "light": "hsla(182.09,64.97%,65.29%,1)",
                                    "dark": "hsla(182.09,64.97%,34.71%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-3",
                                "name": "primary-l-3",
                                "raw": "var(--at-primary-l-3)",
                                "rawValue": {
                                    "light": "hsla(182.02,65.93%,73.53%,1)",
                                    "dark": "hsla(182.02,65.93%,26.47%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-4",
                                "name": "primary-l-4",
                                "raw": "var(--at-primary-l-4)",
                                "rawValue": {
                                    "light": "hsla(181.94,65.96%,81.57%,1)",
                                    "dark": "hsla(181.94,65.96%,18.43%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-5",
                                "name": "primary-l-5",
                                "raw": "var(--at-primary-l-5)",
                                "rawValue": {
                                    "light": "hsla(181.76,65.38%,89.8%,1)",
                                    "dark": "hsla(181.76,65.38%,10.2%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-6",
                                "name": "primary-l-6",
                                "raw": "var(--at-primary-l-6)",
                                "rawValue": {
                                    "light": "hsla(180,63.64%,97.84%,1)",
                                    "dark": "hsla(180,63.64%,2.16%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-1",
                                "name": "primary-d-1",
                                "raw": "var(--at-primary-d-1)",
                                "rawValue": {
                                    "light": "hsla(182.07,68.08%,41.76%,1)",
                                    "dark": "hsla(182.07,68.08%,58.24%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-2",
                                "name": "primary-d-2",
                                "raw": "var(--at-primary-d-2)",
                                "rawValue": {
                                    "light": "hsla(182.02,68%,34.31%,1)",
                                    "dark": "hsla(182.02,68%,65.69%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-3",
                                "name": "primary-d-3",
                                "raw": "var(--at-primary-d-3)",
                                "rawValue": {
                                    "light": "hsla(181.91,68.12%,27.06%,1)",
                                    "dark": "hsla(181.91,68.12%,72.94%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-4",
                                "name": "primary-d-4",
                                "raw": "var(--at-primary-d-4)",
                                "rawValue": {
                                    "light": "hsla(181.76,68%,19.61%,1)",
                                    "dark": "hsla(181.76,68%,80.39%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-5",
                                "name": "primary-d-5",
                                "raw": "var(--at-primary-d-5)",
                                "rawValue": {
                                    "light": "hsla(181.4,68.25%,12.35%,1)",
                                    "dark": "hsla(181.4,68.25%,87.65%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-6",
                                "name": "primary-d-6",
                                "raw": "var(--at-primary-d-6)",
                                "rawValue": {
                                    "light": "hsla(180,68%,4.9%,1)",
                                    "dark": "hsla(180,68%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-1",
                                "name": "primary-t-1",
                                "raw": "var(--at-primary-t-1)",
                                "rawValue": {
                                    "light": "hsla(182.12,68%,49.02%,0.84)",
                                    "dark": "hsla(182.12,68%,50.98%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-2",
                                "name": "primary-t-2",
                                "raw": "var(--at-primary-t-2)",
                                "rawValue": {
                                    "light": "hsla(182.12,68%,49.02%,0.68)",
                                    "dark": "hsla(182.12,68%,50.98%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-3",
                                "name": "primary-t-3",
                                "raw": "var(--at-primary-t-3)",
                                "rawValue": {
                                    "light": "hsla(182.12,68%,49.02%,0.53)",
                                    "dark": "hsla(182.12,68%,50.98%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-4",
                                "name": "primary-t-4",
                                "raw": "var(--at-primary-t-4)",
                                "rawValue": {
                                    "light": "hsla(182.12,68%,49.02%,0.37)",
                                    "dark": "hsla(182.12,68%,50.98%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-5",
                                "name": "primary-t-5",
                                "raw": "var(--at-primary-t-5)",
                                "rawValue": {
                                    "light": "hsla(182.12,68%,49.02%,0.21)",
                                    "dark": "hsla(182.12,68%,50.98%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-6",
                                "name": "primary-t-6",
                                "raw": "var(--at-primary-t-6)",
                                "rawValue": {
                                    "light": "hsla(182.12,68%,49.02%,0.05)",
                                    "dark": "hsla(182.12,68%,50.98%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary",
                                "name": "secondary",
                                "raw": "var(--at-secondary)",
                                "rawValue": {
                                    "light": "hsla(53, 65%, 55%, 1)",
                                    "dark": "hsla(53, 65%, 55%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_secondary-l-1",
                                    "at_secondary-l-2",
                                    "at_secondary-l-3",
                                    "at_secondary-l-4",
                                    "at_secondary-l-5",
                                    "at_secondary-l-6",
                                    "at_secondary-d-1",
                                    "at_secondary-d-2",
                                    "at_secondary-d-3",
                                    "at_secondary-d-4",
                                    "at_secondary-d-5",
                                    "at_secondary-d-6",
                                    "at_secondary-t-1",
                                    "at_secondary-t-2",
                                    "at_secondary-t-3",
                                    "at_secondary-t-4",
                                    "at_secondary-t-5",
                                    "at_secondary-t-6"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-1",
                                "name": "secondary-l-1",
                                "raw": "var(--at-secondary-l-1)",
                                "rawValue": {
                                    "light": "hsla(52.8,65.45%,62.55%,1)",
                                    "dark": "hsla(52.8,65.45%,37.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-2",
                                "name": "secondary-l-2",
                                "raw": "var(--at-secondary-l-2)",
                                "rawValue": {
                                    "light": "hsla(52.8,64.94%,69.8%,1)",
                                    "dark": "hsla(52.8,64.94%,30.2%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-3",
                                "name": "secondary-l-3",
                                "raw": "var(--at-secondary-l-3)",
                                "rawValue": {
                                    "light": "hsla(52.8,64.1%,77.06%,1)",
                                    "dark": "hsla(52.8,64.1%,22.94%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-4",
                                "name": "secondary-l-4",
                                "raw": "var(--at-secondary-l-4)",
                                "rawValue": {
                                    "light": "hsla(52.08,65.43%,84.12%,1)",
                                    "dark": "hsla(52.08,65.43%,15.88%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-5",
                                "name": "secondary-l-5",
                                "raw": "var(--at-secondary-l-5)",
                                "rawValue": {
                                    "light": "hsla(51.72,64.44%,91.18%,1)",
                                    "dark": "hsla(51.72,64.44%,8.82%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-6",
                                "name": "secondary-l-6",
                                "raw": "var(--at-secondary-l-6)",
                                "rawValue": {
                                    "light": "hsla(50,60%,98.04%,1)",
                                    "dark": "hsla(50,60%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-1",
                                "name": "secondary-d-1",
                                "raw": "var(--at-secondary-d-1)",
                                "rawValue": {
                                    "light": "hsla(52.8,53.65%,45.69%,1)",
                                    "dark": "hsla(52.8,53.65%,54.31%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-2",
                                "name": "secondary-d-2",
                                "raw": "var(--at-secondary-d-2)",
                                "rawValue": {
                                    "light": "hsla(52.87,54.01%,36.67%,1)",
                                    "dark": "hsla(52.87,54.01%,63.33%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-3",
                                "name": "secondary-d-3",
                                "raw": "var(--at-secondary-d-3)",
                                "rawValue": {
                                    "light": "hsla(52.99,53.85%,28.04%,1)",
                                    "dark": "hsla(52.99,53.85%,71.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-4",
                                "name": "secondary-d-4",
                                "raw": "var(--at-secondary-d-4)",
                                "rawValue": {
                                    "light": "hsla(53.57,56%,19.61%,1)",
                                    "dark": "hsla(53.57,56%,80.39%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-5",
                                "name": "secondary-d-5",
                                "raw": "var(--at-secondary-d-5)",
                                "rawValue": {
                                    "light": "hsla(51.67,58.06%,12.16%,1)",
                                    "dark": "hsla(51.67,58.06%,87.84%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-6",
                                "name": "secondary-d-6",
                                "raw": "var(--at-secondary-d-6)",
                                "rawValue": {
                                    "light": "hsla(52.94,68%,4.9%,1)",
                                    "dark": "hsla(52.94,68%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-1",
                                "name": "secondary-t-1",
                                "raw": "var(--at-secondary-t-1)",
                                "rawValue": {
                                    "light": "hsla(52.75,65.07%,55.1%,0.84)",
                                    "dark": "hsla(52.75,65.07%,44.9%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-2",
                                "name": "secondary-t-2",
                                "raw": "var(--at-secondary-t-2)",
                                "rawValue": {
                                    "light": "hsla(52.75,65.07%,55.1%,0.68)",
                                    "dark": "hsla(52.75,65.07%,44.9%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-3",
                                "name": "secondary-t-3",
                                "raw": "var(--at-secondary-t-3)",
                                "rawValue": {
                                    "light": "hsla(52.75,65.07%,55.1%,0.53)",
                                    "dark": "hsla(52.75,65.07%,44.9%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-4",
                                "name": "secondary-t-4",
                                "raw": "var(--at-secondary-t-4)",
                                "rawValue": {
                                    "light": "hsla(52.75,65.07%,55.1%,0.37)",
                                    "dark": "hsla(52.75,65.07%,44.9%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-5",
                                "name": "secondary-t-5",
                                "raw": "var(--at-secondary-t-5)",
                                "rawValue": {
                                    "light": "hsla(52.75,65.07%,55.1%,0.21)",
                                    "dark": "hsla(52.75,65.07%,44.9%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-6",
                                "name": "secondary-t-6",
                                "raw": "var(--at-secondary-t-6)",
                                "rawValue": {
                                    "light": "hsla(52.75,65.07%,55.1%,0.05)",
                                    "dark": "hsla(52.75,65.07%,44.9%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral",
                                "name": "neutral",
                                "raw": "var(--at-neutral)",
                                "rawValue": {
                                    "light": "hsla(182, 8%, 50%, 1)",
                                    "dark": "hsla(182, 8%, 50%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_neutral-l-1",
                                    "at_neutral-l-2",
                                    "at_neutral-l-3",
                                    "at_neutral-l-4",
                                    "at_neutral-l-5",
                                    "at_neutral-l-6",
                                    "at_neutral-d-1",
                                    "at_neutral-d-2",
                                    "at_neutral-d-3",
                                    "at_neutral-d-4",
                                    "at_neutral-d-5",
                                    "at_neutral-d-6",
                                    "at_neutral-t-1",
                                    "at_neutral-t-2",
                                    "at_neutral-t-3",
                                    "at_neutral-t-4",
                                    "at_neutral-t-5",
                                    "at_neutral-t-6"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-1",
                                "name": "neutral-l-1",
                                "raw": "var(--at-neutral-l-1)",
                                "rawValue": {
                                    "light": "hsla(183.33,8.41%,58.04%,1)",
                                    "dark": "hsla(183.33,8.41%,41.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-2",
                                "name": "neutral-l-2",
                                "raw": "var(--at-neutral-l-2)",
                                "rawValue": {
                                    "light": "hsla(180,8.05%,65.88%,1)",
                                    "dark": "hsla(180,8.05%,34.12%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-3",
                                "name": "neutral-l-3",
                                "raw": "var(--at-neutral-l-3)",
                                "rawValue": {
                                    "light": "hsla(180,8.27%,73.92%,1)",
                                    "dark": "hsla(180,8.27%,26.08%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-4",
                                "name": "neutral-l-4",
                                "raw": "var(--at-neutral-l-4)",
                                "rawValue": {
                                    "light": "hsla(187.5,8.7%,81.96%,1)",
                                    "dark": "hsla(187.5,8.7%,18.04%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-5",
                                "name": "neutral-l-5",
                                "raw": "var(--at-neutral-l-5)",
                                "rawValue": {
                                    "light": "hsla(180,7.69%,89.8%,1)",
                                    "dark": "hsla(180,7.69%,10.2%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-6",
                                "name": "neutral-l-6",
                                "raw": "var(--at-neutral-l-6)",
                                "rawValue": {
                                    "light": "hsla(180,9.09%,97.84%,1)",
                                    "dark": "hsla(180,9.09%,2.16%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-1",
                                "name": "neutral-d-1",
                                "raw": "var(--at-neutral-d-1)",
                                "rawValue": {
                                    "light": "hsla(180,7.83%,42.55%,1)",
                                    "dark": "hsla(180,7.83%,57.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-2",
                                "name": "neutral-d-2",
                                "raw": "var(--at-neutral-d-2)",
                                "rawValue": {
                                    "light": "hsla(184,8.38%,35.1%,1)",
                                    "dark": "hsla(184,8.38%,64.9%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-3",
                                "name": "neutral-d-3",
                                "raw": "var(--at-neutral-d-3)",
                                "rawValue": {
                                    "light": "hsla(180,7.8%,27.65%,1)",
                                    "dark": "hsla(180,7.8%,72.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-4",
                                "name": "neutral-d-4",
                                "raw": "var(--at-neutral-d-4)",
                                "rawValue": {
                                    "light": "hsla(180,7.84%,20%,1)",
                                    "dark": "hsla(180,7.84%,80%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-5",
                                "name": "neutral-d-5",
                                "raw": "var(--at-neutral-d-5)",
                                "rawValue": {
                                    "light": "hsla(180,7.69%,12.75%,1)",
                                    "dark": "hsla(180,7.69%,87.25%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-6",
                                "name": "neutral-d-6",
                                "raw": "var(--at-neutral-d-6)",
                                "rawValue": {
                                    "light": "hsla(180,7.69%,5.1%,1)",
                                    "dark": "hsla(180,7.69%,94.9%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-1",
                                "name": "neutral-t-1",
                                "raw": "var(--at-neutral-t-1)",
                                "rawValue": {
                                    "light": "hsla(182.86,8.24%,50%,0.84)",
                                    "dark": "hsla(182.86,8.24%,50%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-2",
                                "name": "neutral-t-2",
                                "raw": "var(--at-neutral-t-2)",
                                "rawValue": {
                                    "light": "hsla(182.86,8.24%,50%,0.68)",
                                    "dark": "hsla(182.86,8.24%,50%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-3",
                                "name": "neutral-t-3",
                                "raw": "var(--at-neutral-t-3)",
                                "rawValue": {
                                    "light": "hsla(182.86,8.24%,50%,0.53)",
                                    "dark": "hsla(182.86,8.24%,50%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-4",
                                "name": "neutral-t-4",
                                "raw": "var(--at-neutral-t-4)",
                                "rawValue": {
                                    "light": "hsla(182.86,8.24%,50%,0.37)",
                                    "dark": "hsla(182.86,8.24%,50%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-5",
                                "name": "neutral-t-5",
                                "raw": "var(--at-neutral-t-5)",
                                "rawValue": {
                                    "light": "hsla(182.86,8.24%,50%,0.21)",
                                    "dark": "hsla(182.86,8.24%,50%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-6",
                                "name": "neutral-t-6",
                                "raw": "var(--at-neutral-t-6)",
                                "rawValue": {
                                    "light": "hsla(182.86,8.24%,50%,0.05)",
                                    "dark": "hsla(182.86,8.24%,50%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black",
                                "name": "black",
                                "raw": "var(--at-black)",
                                "rawValue": {
                                    "light": "hsla(0, 0%, 0%, 1)",
                                    "dark": "#ffffff"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_black-t-1",
                                    "at_black-t-2",
                                    "at_black-t-3",
                                    "at_black-t-4",
                                    "at_black-t-5",
                                    "at_black-t-6"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-1",
                                "name": "black-t-1",
                                "raw": "var(--at-black-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.84)",
                                    "dark": "hsla(0,0%,100%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-2",
                                "name": "black-t-2",
                                "raw": "var(--at-black-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.68)",
                                    "dark": "hsla(0,0%,100%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-3",
                                "name": "black-t-3",
                                "raw": "var(--at-black-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.53)",
                                    "dark": "hsla(0,0%,100%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-4",
                                "name": "black-t-4",
                                "raw": "var(--at-black-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.37)",
                                    "dark": "hsla(0,0%,100%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-5",
                                "name": "black-t-5",
                                "raw": "var(--at-black-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.21)",
                                    "dark": "hsla(0,0%,100%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-6",
                                "name": "black-t-6",
                                "raw": "var(--at-black-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.05)",
                                    "dark": "hsla(0,0%,100%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white",
                                "name": "white",
                                "raw": "var(--at-white)",
                                "rawValue": {
                                    "light": "#ffffff",
                                    "dark": "#000000"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_white-t-1",
                                    "at_white-t-2",
                                    "at_white-t-3",
                                    "at_white-t-4",
                                    "at_white-t-5",
                                    "at_white-t-6"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-1",
                                "name": "white-t-1",
                                "raw": "var(--at-white-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.84)",
                                    "dark": "hsla(0,0%,0%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-2",
                                "name": "white-t-2",
                                "raw": "var(--at-white-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.68)",
                                    "dark": "hsla(0,0%,0%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-3",
                                "name": "white-t-3",
                                "raw": "var(--at-white-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.53)",
                                    "dark": "hsla(0,0%,0%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-4",
                                "name": "white-t-4",
                                "raw": "var(--at-white-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.37)",
                                    "dark": "hsla(0,0%,0%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-5",
                                "name": "white-t-5",
                                "raw": "var(--at-white-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.21)",
                                    "dark": "hsla(0,0%,0%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-6",
                                "name": "white-t-6",
                                "raw": "var(--at-white-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.05)",
                                    "dark": "hsla(0,0%,0%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            }
                        ]
                    },
                    {
                        "id": "at_framework_palette_green",
                        "name": "AT Green",
                        "at_framework": true,
                        "at_version": "1.0.0",
                        "status": "disabled",
                        "prefix": "at-",
                        "defaultExpanded": true,
                        "colors": [
                            {
                                "id": "at_primary-green",
                                "name": "primary",
                                "raw": "var(--at-primary)",
                                "rawValue": {
                                    "light": "hsla(141, 74.3%, 51.2%, 1)",
                                    "dark": "hsla(141, 74.3%, 51.2%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_primary-l-1-green",
                                    "at_primary-l-2-green",
                                    "at_primary-l-3-green",
                                    "at_primary-l-4-green",
                                    "at_primary-l-5-green",
                                    "at_primary-l-6-green",
                                    "at_primary-d-1-green",
                                    "at_primary-d-2-green",
                                    "at_primary-d-3-green",
                                    "at_primary-d-4-green",
                                    "at_primary-d-5-green",
                                    "at_primary-d-6-green",
                                    "at_primary-t-1-green",
                                    "at_primary-t-2-green",
                                    "at_primary-t-3-green",
                                    "at_primary-t-4-green",
                                    "at_primary-t-5-green",
                                    "at_primary-t-6-green"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-1-green",
                                "name": "primary-l-1",
                                "raw": "var(--at-primary-l-1)",
                                "rawValue": {
                                    "light": "hsla(140.9,74.16%,59.02%,1)",
                                    "dark": "hsla(140.9,74.16%,40.98%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-2-green",
                                "name": "primary-l-2",
                                "raw": "var(--at-primary-l-2)",
                                "rawValue": {
                                    "light": "hsla(141.43,74.12%,66.67%,1)",
                                    "dark": "hsla(141.43,74.12%,33.33%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-3-green",
                                "name": "primary-l-3",
                                "raw": "var(--at-primary-l-3)",
                                "rawValue": {
                                    "light": "hsla(141.03,75.19%,74.71%,1)",
                                    "dark": "hsla(141.03,75.19%,25.29%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-4-green",
                                "name": "primary-l-4",
                                "raw": "var(--at-primary-l-4)",
                                "rawValue": {
                                    "light": "hsla(140.6,75.28%,82.55%,1)",
                                    "dark": "hsla(140.6,75.28%,17.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-5-green",
                                "name": "primary-l-5",
                                "raw": "var(--at-primary-l-5)",
                                "rawValue": {
                                    "light": "hsla(142.11,76%,90.2%,1)",
                                    "dark": "hsla(142.11,76%,9.8%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-6-green",
                                "name": "primary-l-6",
                                "raw": "var(--at-primary-l-6)",
                                "rawValue": {
                                    "light": "hsla(142.5,80%,98.04%,1)",
                                    "dark": "hsla(142.5,80%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-1-green",
                                "name": "primary-d-1",
                                "raw": "var(--at-primary-d-1)",
                                "rawValue": {
                                    "light": "hsla(141.27,71.17%,43.53%,1)",
                                    "dark": "hsla(141.27,71.17%,56.47%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-2-green",
                                "name": "primary-d-2",
                                "raw": "var(--at-primary-d-2)",
                                "rawValue": {
                                    "light": "hsla(141.23,71.43%,35.69%,1)",
                                    "dark": "hsla(141.23,71.43%,64.31%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-3-green",
                                "name": "primary-d-3",
                                "raw": "var(--at-primary-d-3)",
                                "rawValue": {
                                    "light": "hsla(141.18,70.83%,28.24%,1)",
                                    "dark": "hsla(141.18,70.83%,71.76%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-4-green",
                                "name": "primary-d-4",
                                "raw": "var(--at-primary-d-4)",
                                "rawValue": {
                                    "light": "hsla(141.08,71.15%,20.39%,1)",
                                    "dark": "hsla(141.08,71.15%,79.61%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-5-green",
                                "name": "primary-d-5",
                                "raw": "var(--at-primary-d-5)",
                                "rawValue": {
                                    "light": "hsla(141.7,72.31%,12.75%,1)",
                                    "dark": "hsla(141.7,72.31%,87.25%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-6-green",
                                "name": "primary-d-6",
                                "raw": "var(--at-primary-d-6)",
                                "rawValue": {
                                    "light": "hsla(142.11,76%,4.9%,1)",
                                    "dark": "hsla(142.11,76%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-1-green",
                                "name": "primary-t-1",
                                "raw": "var(--at-primary-t-1)",
                                "rawValue": {
                                    "light": "hsla(141.08,74.3%,51.18%,0.84)",
                                    "dark": "hsla(141.08,74.3%,48.82%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-2-green",
                                "name": "primary-t-2",
                                "raw": "var(--at-primary-t-2)",
                                "rawValue": {
                                    "light": "hsla(141.08,74.3%,51.18%,0.68)",
                                    "dark": "hsla(141.08,74.3%,48.82%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-3-green",
                                "name": "primary-t-3",
                                "raw": "var(--at-primary-t-3)",
                                "rawValue": {
                                    "light": "hsla(141.08,74.3%,51.18%,0.53)",
                                    "dark": "hsla(141.08,74.3%,48.82%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-4-green",
                                "name": "primary-t-4",
                                "raw": "var(--at-primary-t-4)",
                                "rawValue": {
                                    "light": "hsla(141.08,74.3%,51.18%,0.37)",
                                    "dark": "hsla(141.08,74.3%,48.82%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-5-green",
                                "name": "primary-t-5",
                                "raw": "var(--at-primary-t-5)",
                                "rawValue": {
                                    "light": "hsla(141.08,74.3%,51.18%,0.21)",
                                    "dark": "hsla(141.08,74.3%,48.82%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-6-green",
                                "name": "primary-t-6",
                                "raw": "var(--at-primary-t-6)",
                                "rawValue": {
                                    "light": "hsla(141.08,74.3%,51.18%,0.05)",
                                    "dark": "hsla(141.08,74.3%,48.82%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-green",
                                "name": "secondary",
                                "raw": "var(--at-secondary)",
                                "rawValue": {
                                    "light": "hsla(186, 65%, 55%, 1)",
                                    "dark": "hsla(186, 65%, 55%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_secondary-l-1-green",
                                    "at_secondary-l-2-green",
                                    "at_secondary-l-3-green",
                                    "at_secondary-l-4-green",
                                    "at_secondary-l-5-green",
                                    "at_secondary-l-6-green",
                                    "at_secondary-d-1-green",
                                    "at_secondary-d-2-green",
                                    "at_secondary-d-3-green",
                                    "at_secondary-d-4-green",
                                    "at_secondary-d-5-green",
                                    "at_secondary-d-6-green",
                                    "at_secondary-t-1-green",
                                    "at_secondary-t-2-green",
                                    "at_secondary-t-3-green",
                                    "at_secondary-t-4-green",
                                    "at_secondary-t-5-green",
                                    "at_secondary-t-6-green"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-1-green",
                                "name": "secondary-l-1",
                                "raw": "var(--at-secondary-l-1)",
                                "rawValue": {
                                    "light": "hsla(185.76,64.77%,62.16%,1)",
                                    "dark": "hsla(185.76,64.77%,37.84%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-2-green",
                                "name": "secondary-l-2",
                                "raw": "var(--at-secondary-l-2)",
                                "rawValue": {
                                    "light": "hsla(185.88,65.38%,69.41%,1)",
                                    "dark": "hsla(185.88,65.38%,30.59%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-3-green",
                                "name": "secondary-l-3",
                                "raw": "var(--at-secondary-l-3)",
                                "rawValue": {
                                    "light": "hsla(185.45,64.71%,76.67%,1)",
                                    "dark": "hsla(185.45,64.71%,23.33%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-4-green",
                                "name": "secondary-l-4",
                                "raw": "var(--at-secondary-l-4)",
                                "rawValue": {
                                    "light": "hsla(185.66,63.86%,83.73%,1)",
                                    "dark": "hsla(185.66,63.86%,16.27%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-5-green",
                                "name": "secondary-l-5",
                                "raw": "var(--at-secondary-l-5)",
                                "rawValue": {
                                    "light": "hsla(186,65.22%,90.98%,1)",
                                    "dark": "hsla(186,65.22%,9.02%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-6-green",
                                "name": "secondary-l-6",
                                "raw": "var(--at-secondary-l-6)",
                                "rawValue": {
                                    "light": "hsla(180,60%,98.04%,1)",
                                    "dark": "hsla(180,60%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-1-green",
                                "name": "secondary-d-1",
                                "raw": "var(--at-secondary-d-1)",
                                "rawValue": {
                                    "light": "hsla(186.14,53.14%,46.86%,1)",
                                    "dark": "hsla(186.14,53.14%,53.14%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-2-green",
                                "name": "secondary-d-2",
                                "raw": "var(--at-secondary-d-2)",
                                "rawValue": {
                                    "light": "hsla(185.71,53.85%,38.24%,1)",
                                    "dark": "hsla(185.71,53.85%,61.76%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-3-green",
                                "name": "secondary-d-3",
                                "raw": "var(--at-secondary-d-3)",
                                "rawValue": {
                                    "light": "hsla(185.78,54.25%,30%,1)",
                                    "dark": "hsla(185.78,54.25%,70%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-4-green",
                                "name": "secondary-d-4",
                                "raw": "var(--at-secondary-d-4)",
                                "rawValue": {
                                    "light": "hsla(186.89,54.95%,21.76%,1)",
                                    "dark": "hsla(186.89,54.95%,78.24%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-5-green",
                                "name": "secondary-d-5",
                                "raw": "var(--at-secondary-d-5)",
                                "rawValue": {
                                    "light": "hsla(186.15,58.21%,13.14%,1)",
                                    "dark": "hsla(186.15,58.21%,86.86%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-6-green",
                                "name": "secondary-d-6",
                                "raw": "var(--at-secondary-d-6)",
                                "rawValue": {
                                    "light": "hsla(187.06,68%,4.9%,1)",
                                    "dark": "hsla(187.06,68%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-1-green",
                                "name": "secondary-t-1",
                                "raw": "var(--at-secondary-t-1)",
                                "rawValue": {
                                    "light": "hsla(186.04,65.07%,55.1%,0.84)",
                                    "dark": "hsla(186.04,65.07%,44.9%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-2-green",
                                "name": "secondary-t-2",
                                "raw": "var(--at-secondary-t-2)",
                                "rawValue": {
                                    "light": "hsla(186.04,65.07%,55.1%,0.68)",
                                    "dark": "hsla(186.04,65.07%,44.9%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-3-green",
                                "name": "secondary-t-3",
                                "raw": "var(--at-secondary-t-3)",
                                "rawValue": {
                                    "light": "hsla(186.04,65.07%,55.1%,0.53)",
                                    "dark": "hsla(186.04,65.07%,44.9%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-4-green",
                                "name": "secondary-t-4",
                                "raw": "var(--at-secondary-t-4)",
                                "rawValue": {
                                    "light": "hsla(186.04,65.07%,55.1%,0.37)",
                                    "dark": "hsla(186.04,65.07%,44.9%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-5-green",
                                "name": "secondary-t-5",
                                "raw": "var(--at-secondary-t-5)",
                                "rawValue": {
                                    "light": "hsla(186.04,65.07%,55.1%,0.21)",
                                    "dark": "hsla(186.04,65.07%,44.9%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-6-green",
                                "name": "secondary-t-6",
                                "raw": "var(--at-secondary-t-6)",
                                "rawValue": {
                                    "light": "hsla(186.04,65.07%,55.1%,0.05)",
                                    "dark": "hsla(186.04,65.07%,44.9%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-green",
                                "name": "neutral",
                                "raw": "var(--at-neutral)",
                                "rawValue": {
                                    "light": "hsla(141, 20%, 50%, 1)",
                                    "dark": "hsla(141, 20%, 50%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_neutral-l-1-green",
                                    "at_neutral-l-2-green",
                                    "at_neutral-l-3-green",
                                    "at_neutral-l-4-green",
                                    "at_neutral-l-5-green",
                                    "at_neutral-l-6-green",
                                    "at_neutral-d-1-green",
                                    "at_neutral-d-2-green",
                                    "at_neutral-d-3-green",
                                    "at_neutral-d-4-green",
                                    "at_neutral-d-5-green",
                                    "at_neutral-d-6-green",
                                    "at_neutral-t-1-green",
                                    "at_neutral-t-2-green",
                                    "at_neutral-t-3-green",
                                    "at_neutral-t-4-green",
                                    "at_neutral-t-5-green",
                                    "at_neutral-t-6-green"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-1-green",
                                "name": "neutral-l-1",
                                "raw": "var(--at-neutral-l-1)",
                                "rawValue": {
                                    "light": "hsla(141.43,19.63%,58.04%,1)",
                                    "dark": "hsla(141.43,19.63%,41.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-2-green",
                                "name": "neutral-l-2",
                                "raw": "var(--at-neutral-l-2)",
                                "rawValue": {
                                    "light": "hsla(140.57,20.23%,66.08%,1)",
                                    "dark": "hsla(140.57,20.23%,33.92%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-3-green",
                                "name": "neutral-l-3",
                                "raw": "var(--at-neutral-l-3)",
                                "rawValue": {
                                    "light": "hsla(140.77,19.7%,74.12%,1)",
                                    "dark": "hsla(140.77,19.7%,25.88%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-4-green",
                                "name": "neutral-l-4",
                                "raw": "var(--at-neutral-l-4)",
                                "rawValue": {
                                    "light": "hsla(143.33,19.57%,81.96%,1)",
                                    "dark": "hsla(143.33,19.57%,18.04%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-5-green",
                                "name": "neutral-l-5",
                                "raw": "var(--at-neutral-l-5)",
                                "rawValue": {
                                    "light": "hsla(138,20%,90.2%,1)",
                                    "dark": "hsla(138,20%,9.8%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-6-green",
                                "name": "neutral-l-6",
                                "raw": "var(--at-neutral-l-6)",
                                "rawValue": {
                                    "light": "hsla(150,20%,98.04%,1)",
                                    "dark": "hsla(150,20%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-1-green",
                                "name": "neutral-d-1",
                                "raw": "var(--at-neutral-d-1)",
                                "rawValue": {
                                    "light": "hsla(140.93,19.82%,42.55%,1)",
                                    "dark": "hsla(140.93,19.82%,57.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-2-green",
                                "name": "neutral-d-2",
                                "raw": "var(--at-neutral-d-2)",
                                "rawValue": {
                                    "light": "hsla(141.67,20.22%,34.9%,1)",
                                    "dark": "hsla(141.67,20.22%,65.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-3-green",
                                "name": "neutral-d-3",
                                "raw": "var(--at-neutral-d-3)",
                                "rawValue": {
                                    "light": "hsla(141.43,20%,27.45%,1)",
                                    "dark": "hsla(141.43,20%,72.55%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-4-green",
                                "name": "neutral-d-4",
                                "raw": "var(--at-neutral-d-4)",
                                "rawValue": {
                                    "light": "hsla(141,19.61%,20%,1)",
                                    "dark": "hsla(141,19.61%,80%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-5-green",
                                "name": "neutral-d-5",
                                "raw": "var(--at-neutral-d-5)",
                                "rawValue": {
                                    "light": "hsla(143.08,20.63%,12.35%,1)",
                                    "dark": "hsla(143.08,20.63%,87.65%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-6-green",
                                "name": "neutral-d-6",
                                "raw": "var(--at-neutral-d-6)",
                                "rawValue": {
                                    "light": "hsla(144,20%,4.9%,1)",
                                    "dark": "hsla(144,20%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-1-green",
                                "name": "neutral-t-1",
                                "raw": "var(--at-neutral-t-1)",
                                "rawValue": {
                                    "light": "hsla(141.18,20%,50%,0.84)",
                                    "dark": "hsla(141.18,20%,50%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-2-green",
                                "name": "neutral-t-2",
                                "raw": "var(--at-neutral-t-2)",
                                "rawValue": {
                                    "light": "hsla(141.18,20%,50%,0.68)",
                                    "dark": "hsla(141.18,20%,50%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-3-green",
                                "name": "neutral-t-3",
                                "raw": "var(--at-neutral-t-3)",
                                "rawValue": {
                                    "light": "hsla(141.18,20%,50%,0.53)",
                                    "dark": "hsla(141.18,20%,50%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-4-green",
                                "name": "neutral-t-4",
                                "raw": "var(--at-neutral-t-4)",
                                "rawValue": {
                                    "light": "hsla(141.18,20%,50%,0.37)",
                                    "dark": "hsla(141.18,20%,50%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-5-green",
                                "name": "neutral-t-5",
                                "raw": "var(--at-neutral-t-5)",
                                "rawValue": {
                                    "light": "hsla(141.18,20%,50%,0.21)",
                                    "dark": "hsla(141.18,20%,50%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-6-green",
                                "name": "neutral-t-6",
                                "raw": "var(--at-neutral-t-6)",
                                "rawValue": {
                                    "light": "hsla(141.18,20%,50%,0.05)",
                                    "dark": "hsla(141.18,20%,50%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-green",
                                "name": "black",
                                "raw": "var(--at-black)",
                                "rawValue": {
                                    "light": "hsla(0, 0%, 0%, 1)",
                                    "dark": "#ffffff"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_black-t-1-green",
                                    "at_black-t-2-green",
                                    "at_black-t-3-green",
                                    "at_black-t-4-green",
                                    "at_black-t-5-green",
                                    "at_black-t-6-green"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-1-green",
                                "name": "black-t-1",
                                "raw": "var(--at-black-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.84)",
                                    "dark": "hsla(0,0%,100%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-2-green",
                                "name": "black-t-2",
                                "raw": "var(--at-black-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.68)",
                                    "dark": "hsla(0,0%,100%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-3-green",
                                "name": "black-t-3",
                                "raw": "var(--at-black-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.53)",
                                    "dark": "hsla(0,0%,100%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-4-green",
                                "name": "black-t-4",
                                "raw": "var(--at-black-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.37)",
                                    "dark": "hsla(0,0%,100%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-5-green",
                                "name": "black-t-5",
                                "raw": "var(--at-black-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.21)",
                                    "dark": "hsla(0,0%,100%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-6-green",
                                "name": "black-t-6",
                                "raw": "var(--at-black-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.05)",
                                    "dark": "hsla(0,0%,100%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-green",
                                "name": "white",
                                "raw": "var(--at-white)",
                                "rawValue": {
                                    "light": "#ffffff",
                                    "dark": "#000000"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_white-t-1-green",
                                    "at_white-t-2-green",
                                    "at_white-t-3-green",
                                    "at_white-t-4-green",
                                    "at_white-t-5-green",
                                    "at_white-t-6-green"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-1-green",
                                "name": "white-t-1",
                                "raw": "var(--at-white-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.84)",
                                    "dark": "hsla(0,0%,0%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-green",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-2-green",
                                "name": "white-t-2",
                                "raw": "var(--at-white-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.68)",
                                    "dark": "hsla(0,0%,0%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-green",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-3-green",
                                "name": "white-t-3",
                                "raw": "var(--at-white-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.53)",
                                    "dark": "hsla(0,0%,0%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-green",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-4-green",
                                "name": "white-t-4",
                                "raw": "var(--at-white-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.37)",
                                    "dark": "hsla(0,0%,0%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-green",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-5-green",
                                "name": "white-t-5",
                                "raw": "var(--at-white-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.21)",
                                    "dark": "hsla(0,0%,0%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-green",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-6-green",
                                "name": "white-t-6",
                                "raw": "var(--at-white-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.05)",
                                    "dark": "hsla(0,0%,0%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-green",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            }
                        ]
                    },
                    {
                        "id": "at_framework_palette_red",
                        "name": "AT Red",
                        "at_framework": true,
                        "at_version": "1.0.0",
                        "status": "disabled",
                        "prefix": "at-",
                        "defaultExpanded": true,
                        "colors": [
                            {
                                "id": "at_primary-red",
                                "name": "primary",
                                "raw": "var(--at-primary)",
                                "rawValue": {
                                    "light": "hsla(359, 81.7%, 45.1%, 1)",
                                    "dark": "hsla(359, 81.7%, 45.1%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_primary-l-1-red",
                                    "at_primary-l-2-red",
                                    "at_primary-l-3-red",
                                    "at_primary-l-4-red",
                                    "at_primary-l-5-red",
                                    "at_primary-l-6-red",
                                    "at_primary-d-1-red",
                                    "at_primary-d-2-red",
                                    "at_primary-d-3-red",
                                    "at_primary-d-4-red",
                                    "at_primary-d-5-red",
                                    "at_primary-d-6-red",
                                    "at_primary-t-1-red",
                                    "at_primary-t-2-red",
                                    "at_primary-t-3-red",
                                    "at_primary-t-4-red",
                                    "at_primary-t-5-red",
                                    "at_primary-t-6-red"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-1-red",
                                "name": "primary-l-1",
                                "raw": "var(--at-primary-l-1)",
                                "rawValue": {
                                    "light": "hsla(359.24,67.52%,54.12%,1)",
                                    "dark": "hsla(359.24,67.52%,45.88%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-2-red",
                                "name": "primary-l-2",
                                "raw": "var(--at-primary-l-2)",
                                "rawValue": {
                                    "light": "hsla(359.06,67.37%,62.75%,1)",
                                    "dark": "hsla(359.06,67.37%,37.25%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-3-red",
                                "name": "primary-l-3",
                                "raw": "var(--at-primary-l-3)",
                                "rawValue": {
                                    "light": "hsla(359.39,68.06%,71.76%,1)",
                                    "dark": "hsla(359.39,68.06%,28.24%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-4-red",
                                "name": "primary-l-4",
                                "raw": "var(--at-primary-l-4)",
                                "rawValue": {
                                    "light": "hsla(359.12,68%,80.39%,1)",
                                    "dark": "hsla(359.12,68%,19.61%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-5-red",
                                "name": "primary-l-5",
                                "raw": "var(--at-primary-l-5)",
                                "rawValue": {
                                    "light": "hsla(0,70.37%,89.41%,1)",
                                    "dark": "hsla(0,70.37%,10.59%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-6-red",
                                "name": "primary-l-6",
                                "raw": "var(--at-primary-l-6)",
                                "rawValue": {
                                    "light": "hsla(0,80%,98.04%,1)",
                                    "dark": "hsla(0,80%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-1-red",
                                "name": "primary-d-1",
                                "raw": "var(--at-primary-d-1)",
                                "rawValue": {
                                    "light": "hsla(358.88,81.63%,38.43%,1)",
                                    "dark": "hsla(358.88,81.63%,61.57%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-2-red",
                                "name": "primary-d-2",
                                "raw": "var(--at-primary-d-2)",
                                "rawValue": {
                                    "light": "hsla(359.09,81.48%,31.76%,1)",
                                    "dark": "hsla(359.09,81.48%,68.24%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-3-red",
                                "name": "primary-d-3",
                                "raw": "var(--at-primary-d-3)",
                                "rawValue": {
                                    "light": "hsla(358.85,81.25%,25.1%,1)",
                                    "dark": "hsla(358.85,81.25%,74.9%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-4-red",
                                "name": "primary-d-4",
                                "raw": "var(--at-primary-d-4)",
                                "rawValue": {
                                    "light": "hsla(358.44,82.8%,18.24%,1)",
                                    "dark": "hsla(358.44,82.8%,81.76%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-5-red",
                                "name": "primary-d-5",
                                "raw": "var(--at-primary-d-5)",
                                "rawValue": {
                                    "light": "hsla(357.55,83.05%,11.57%,1)",
                                    "dark": "hsla(357.55,83.05%,88.43%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-6-red",
                                "name": "primary-d-6",
                                "raw": "var(--at-primary-d-6)",
                                "rawValue": {
                                    "light": "hsla(357.14,84%,4.9%,1)",
                                    "dark": "hsla(357.14,84%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-1-red",
                                "name": "primary-t-1",
                                "raw": "var(--at-primary-t-1)",
                                "rawValue": {
                                    "light": "hsla(359.04,81.74%,45.1%,0.84)",
                                    "dark": "hsla(359.04,81.74%,54.9%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-2-red",
                                "name": "primary-t-2",
                                "raw": "var(--at-primary-t-2)",
                                "rawValue": {
                                    "light": "hsla(359.04,81.74%,45.1%,0.68)",
                                    "dark": "hsla(359.04,81.74%,54.9%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-3-red",
                                "name": "primary-t-3",
                                "raw": "var(--at-primary-t-3)",
                                "rawValue": {
                                    "light": "hsla(359.04,81.74%,45.1%,0.53)",
                                    "dark": "hsla(359.04,81.74%,54.9%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-4-red",
                                "name": "primary-t-4",
                                "raw": "var(--at-primary-t-4)",
                                "rawValue": {
                                    "light": "hsla(359.04,81.74%,45.1%,0.37)",
                                    "dark": "hsla(359.04,81.74%,54.9%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-5-red",
                                "name": "primary-t-5",
                                "raw": "var(--at-primary-t-5)",
                                "rawValue": {
                                    "light": "hsla(359.04,81.74%,45.1%,0.21)",
                                    "dark": "hsla(359.04,81.74%,54.9%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-6-red",
                                "name": "primary-t-6",
                                "raw": "var(--at-primary-t-6)",
                                "rawValue": {
                                    "light": "hsla(359.04,81.74%,45.1%,0.05)",
                                    "dark": "hsla(359.04,81.74%,54.9%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-red",
                                "name": "secondary",
                                "raw": "var(--at-secondary)",
                                "rawValue": {
                                    "light": "hsla(18, 70%, 59%, 1)",
                                    "dark": "hsla(18, 70%, 59%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_secondary-l-1-red",
                                    "at_secondary-l-2-red",
                                    "at_secondary-l-3-red",
                                    "at_secondary-l-4-red",
                                    "at_secondary-l-5-red",
                                    "at_secondary-l-6-red",
                                    "at_secondary-d-1-red",
                                    "at_secondary-d-2-red",
                                    "at_secondary-d-3-red",
                                    "at_secondary-d-4-red",
                                    "at_secondary-d-5-red",
                                    "at_secondary-d-6-red",
                                    "at_secondary-t-1-red",
                                    "at_secondary-t-2-red",
                                    "at_secondary-t-3-red",
                                    "at_secondary-t-4-red",
                                    "at_secondary-t-5-red",
                                    "at_secondary-t-6-red"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-1-red",
                                "name": "secondary-l-1",
                                "raw": "var(--at-secondary-l-1)",
                                "rawValue": {
                                    "light": "hsla(17.9,70.45%,65.49%,1)",
                                    "dark": "hsla(17.9,70.45%,34.51%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-2-red",
                                "name": "secondary-l-2",
                                "raw": "var(--at-secondary-l-2)",
                                "rawValue": {
                                    "light": "hsla(17.82,70.63%,71.96%,1)",
                                    "dark": "hsla(17.82,70.63%,28.04%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-3-red",
                                "name": "secondary-l-3",
                                "raw": "var(--at-secondary-l-3)",
                                "rawValue": {
                                    "light": "hsla(17.92,70.64%,78.63%,1)",
                                    "dark": "hsla(17.92,70.64%,21.37%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-4-red",
                                "name": "secondary-l-4",
                                "raw": "var(--at-secondary-l-4)",
                                "rawValue": {
                                    "light": "hsla(18.11,68.83%,84.9%,1)",
                                    "dark": "hsla(18.11,68.83%,15.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-5-red",
                                "name": "secondary-l-5",
                                "raw": "var(--at-secondary-l-5)",
                                "rawValue": {
                                    "light": "hsla(18,68.18%,91.37%,1)",
                                    "dark": "hsla(18,68.18%,8.63%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-6-red",
                                "name": "secondary-l-6",
                                "raw": "var(--at-secondary-l-6)",
                                "rawValue": {
                                    "light": "hsla(17.14,63.64%,97.84%,1)",
                                    "dark": "hsla(17.14,63.64%,2.16%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-1-red",
                                "name": "secondary-d-1",
                                "raw": "var(--at-secondary-d-1)",
                                "rawValue": {
                                    "light": "hsla(17.76,49.02%,50%,1)",
                                    "dark": "hsla(17.76,49.02%,50%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-2-red",
                                "name": "secondary-d-2",
                                "raw": "var(--at-secondary-d-2)",
                                "rawValue": {
                                    "light": "hsla(17.88,49.52%,41.18%,1)",
                                    "dark": "hsla(17.88,49.52%,58.82%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-3-red",
                                "name": "secondary-d-3",
                                "raw": "var(--at-secondary-d-3)",
                                "rawValue": {
                                    "light": "hsla(17.56,50%,32.16%,1)",
                                    "dark": "hsla(17.56,50%,67.84%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-4-red",
                                "name": "secondary-d-4",
                                "raw": "var(--at-secondary-d-4)",
                                "rawValue": {
                                    "light": "hsla(17.7,52.14%,22.94%,1)",
                                    "dark": "hsla(17.7,52.14%,77.06%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-5-red",
                                "name": "secondary-d-5",
                                "raw": "var(--at-secondary-d-5)",
                                "rawValue": {
                                    "light": "hsla(18,55.56%,14.12%,1)",
                                    "dark": "hsla(18,55.56%,85.88%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-6-red",
                                "name": "secondary-d-6",
                                "raw": "var(--at-secondary-d-6)",
                                "rawValue": {
                                    "light": "hsla(16.67,69.23%,5.1%,1)",
                                    "dark": "hsla(16.67,69.23%,94.9%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-1-red",
                                "name": "secondary-t-1",
                                "raw": "var(--at-secondary-t-1)",
                                "rawValue": {
                                    "light": "hsla(17.96,70.33%,59.02%,0.84)",
                                    "dark": "hsla(17.96,70.33%,40.98%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-2-red",
                                "name": "secondary-t-2",
                                "raw": "var(--at-secondary-t-2)",
                                "rawValue": {
                                    "light": "hsla(17.96,70.33%,59.02%,0.68)",
                                    "dark": "hsla(17.96,70.33%,40.98%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-3-red",
                                "name": "secondary-t-3",
                                "raw": "var(--at-secondary-t-3)",
                                "rawValue": {
                                    "light": "hsla(17.96,70.33%,59.02%,0.53)",
                                    "dark": "hsla(17.96,70.33%,40.98%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-4-red",
                                "name": "secondary-t-4",
                                "raw": "var(--at-secondary-t-4)",
                                "rawValue": {
                                    "light": "hsla(17.96,70.33%,59.02%,0.37)",
                                    "dark": "hsla(17.96,70.33%,40.98%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-5-red",
                                "name": "secondary-t-5",
                                "raw": "var(--at-secondary-t-5)",
                                "rawValue": {
                                    "light": "hsla(17.96,70.33%,59.02%,0.21)",
                                    "dark": "hsla(17.96,70.33%,40.98%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-6-red",
                                "name": "secondary-t-6",
                                "raw": "var(--at-secondary-t-6)",
                                "rawValue": {
                                    "light": "hsla(17.96,70.33%,59.02%,0.05)",
                                    "dark": "hsla(17.96,70.33%,40.98%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-red",
                                "name": "neutral",
                                "raw": "var(--at-neutral)",
                                "rawValue": {
                                    "light": "hsla(359, 7%, 50%, 1)",
                                    "dark": "hsla(359, 7%, 50%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_neutral-l-1-red",
                                    "at_neutral-l-2-red",
                                    "at_neutral-l-3-red",
                                    "at_neutral-l-4-red",
                                    "at_neutral-l-5-red",
                                    "at_neutral-l-6-red",
                                    "at_neutral-d-1-red",
                                    "at_neutral-d-2-red",
                                    "at_neutral-d-3-red",
                                    "at_neutral-d-4-red",
                                    "at_neutral-d-5-red",
                                    "at_neutral-d-6-red",
                                    "at_neutral-t-1-red",
                                    "at_neutral-t-2-red",
                                    "at_neutral-t-3-red",
                                    "at_neutral-t-4-red",
                                    "at_neutral-t-5-red",
                                    "at_neutral-t-6-red"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-1-red",
                                "name": "neutral-l-1",
                                "raw": "var(--at-neutral-l-1)",
                                "rawValue": {
                                    "light": "hsla(0,6.54%,58.04%,1)",
                                    "dark": "hsla(0,6.54%,41.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-2-red",
                                "name": "neutral-l-2",
                                "raw": "var(--at-neutral-l-2)",
                                "rawValue": {
                                    "light": "hsla(0,6.36%,66.08%,1)",
                                    "dark": "hsla(0,6.36%,33.92%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-3-red",
                                "name": "neutral-l-3",
                                "raw": "var(--at-neutral-l-3)",
                                "rawValue": {
                                    "light": "hsla(0,6.06%,74.12%,1)",
                                    "dark": "hsla(0,6.06%,25.88%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-4-red",
                                "name": "neutral-l-4",
                                "raw": "var(--at-neutral-l-4)",
                                "rawValue": {
                                    "light": "hsla(0,6.52%,81.96%,1)",
                                    "dark": "hsla(0,6.52%,18.04%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-5-red",
                                "name": "neutral-l-5",
                                "raw": "var(--at-neutral-l-5)",
                                "rawValue": {
                                    "light": "hsla(0,5.88%,90%,1)",
                                    "dark": "hsla(0,5.88%,10%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-6-red",
                                "name": "neutral-l-6",
                                "raw": "var(--at-neutral-l-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,98.04%,1)",
                                    "dark": "hsla(0,0%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-1-red",
                                "name": "neutral-d-1",
                                "raw": "var(--at-neutral-d-1)",
                                "rawValue": {
                                    "light": "hsla(0,6.91%,42.55%,1)",
                                    "dark": "hsla(0,6.91%,57.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-2-red",
                                "name": "neutral-d-2",
                                "raw": "var(--at-neutral-d-2)",
                                "rawValue": {
                                    "light": "hsla(0,6.74%,34.9%,1)",
                                    "dark": "hsla(0,6.74%,65.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-3-red",
                                "name": "neutral-d-3",
                                "raw": "var(--at-neutral-d-3)",
                                "rawValue": {
                                    "light": "hsla(0,6.38%,27.65%,1)",
                                    "dark": "hsla(0,6.38%,72.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-4-red",
                                "name": "neutral-d-4",
                                "raw": "var(--at-neutral-d-4)",
                                "rawValue": {
                                    "light": "hsla(0,6.8%,20.2%,1)",
                                    "dark": "hsla(0,6.8%,79.8%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-5-red",
                                "name": "neutral-d-5",
                                "raw": "var(--at-neutral-d-5)",
                                "rawValue": {
                                    "light": "hsla(0,6.25%,12.55%,1)",
                                    "dark": "hsla(0,6.25%,87.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-6-red",
                                "name": "neutral-d-6",
                                "raw": "var(--at-neutral-d-6)",
                                "rawValue": {
                                    "light": "hsla(0,7.69%,5.1%,1)",
                                    "dark": "hsla(0,7.69%,94.9%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-1-red",
                                "name": "neutral-t-1",
                                "raw": "var(--at-neutral-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,6.67%,50%,0.84)",
                                    "dark": "hsla(0,6.67%,50%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-2-red",
                                "name": "neutral-t-2",
                                "raw": "var(--at-neutral-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,6.67%,50%,0.68)",
                                    "dark": "hsla(0,6.67%,50%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-3-red",
                                "name": "neutral-t-3",
                                "raw": "var(--at-neutral-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,6.67%,50%,0.53)",
                                    "dark": "hsla(0,6.67%,50%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-4-red",
                                "name": "neutral-t-4",
                                "raw": "var(--at-neutral-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,6.67%,50%,0.37)",
                                    "dark": "hsla(0,6.67%,50%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-5-red",
                                "name": "neutral-t-5",
                                "raw": "var(--at-neutral-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,6.67%,50%,0.21)",
                                    "dark": "hsla(0,6.67%,50%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-6-red",
                                "name": "neutral-t-6",
                                "raw": "var(--at-neutral-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,6.67%,50%,0.05)",
                                    "dark": "hsla(0,6.67%,50%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-red",
                                "name": "black",
                                "raw": "var(--at-black)",
                                "rawValue": {
                                    "light": "hsla(0, 0%, 0%, 1)",
                                    "dark": "#ffffff"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_black-t-1-red",
                                    "at_black-t-2-red",
                                    "at_black-t-3-red",
                                    "at_black-t-4-red",
                                    "at_black-t-5-red",
                                    "at_black-t-6-red"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-1-red",
                                "name": "black-t-1",
                                "raw": "var(--at-black-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.84)",
                                    "dark": "hsla(0,0%,100%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-2-red",
                                "name": "black-t-2",
                                "raw": "var(--at-black-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.68)",
                                    "dark": "hsla(0,0%,100%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-3-red",
                                "name": "black-t-3",
                                "raw": "var(--at-black-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.53)",
                                    "dark": "hsla(0,0%,100%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-4-red",
                                "name": "black-t-4",
                                "raw": "var(--at-black-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.37)",
                                    "dark": "hsla(0,0%,100%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-5-red",
                                "name": "black-t-5",
                                "raw": "var(--at-black-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.21)",
                                    "dark": "hsla(0,0%,100%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-6-red",
                                "name": "black-t-6",
                                "raw": "var(--at-black-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.05)",
                                    "dark": "hsla(0,0%,100%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-red",
                                "name": "white",
                                "raw": "var(--at-white)",
                                "rawValue": {
                                    "light": "#ffffff",
                                    "dark": "#000000"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_white-t-1-red",
                                    "at_white-t-2-red",
                                    "at_white-t-3-red",
                                    "at_white-t-4-red",
                                    "at_white-t-5-red",
                                    "at_white-t-6-red"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-1-red",
                                "name": "white-t-1",
                                "raw": "var(--at-white-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.84)",
                                    "dark": "hsla(0,0%,0%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-red",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-2-red",
                                "name": "white-t-2",
                                "raw": "var(--at-white-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.68)",
                                    "dark": "hsla(0,0%,0%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-red",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-3-red",
                                "name": "white-t-3",
                                "raw": "var(--at-white-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.53)",
                                    "dark": "hsla(0,0%,0%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-red",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-4-red",
                                "name": "white-t-4",
                                "raw": "var(--at-white-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.37)",
                                    "dark": "hsla(0,0%,0%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-red",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-5-red",
                                "name": "white-t-5",
                                "raw": "var(--at-white-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.21)",
                                    "dark": "hsla(0,0%,0%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-red",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-6-red",
                                "name": "white-t-6",
                                "raw": "var(--at-white-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.05)",
                                    "dark": "hsla(0,0%,0%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-red",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            }
                        ]
                    },
                    {
                        "id": "at_framework_palette_nature",
                        "name": "AT Nature",
                        "at_framework": true,
                        "at_version": "1.0.0",
                        "status": "disabled",
                        "prefix": "at-",
                        "defaultExpanded": true,
                        "colors": [
                            {
                                "id": "at_primary-nature",
                                "name": "primary",
                                "raw": "var(--at-primary)",
                                "rawValue": {
                                    "light": "hsla(29, 79.9%, 37.1%, 1)",
                                    "dark": "hsla(29, 79.9%, 37.1%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_primary-l-1-nature",
                                    "at_primary-l-2-nature",
                                    "at_primary-l-3-nature",
                                    "at_primary-l-4-nature",
                                    "at_primary-l-5-nature",
                                    "at_primary-l-6-nature",
                                    "at_primary-d-1-nature",
                                    "at_primary-d-2-nature",
                                    "at_primary-d-3-nature",
                                    "at_primary-d-4-nature",
                                    "at_primary-d-5-nature",
                                    "at_primary-d-6-nature",
                                    "at_primary-t-1-nature",
                                    "at_primary-t-2-nature",
                                    "at_primary-t-3-nature",
                                    "at_primary-t-4-nature",
                                    "at_primary-t-5-nature",
                                    "at_primary-t-6-nature"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-1-nature",
                                "name": "primary-l-1",
                                "raw": "var(--at-primary-l-1)",
                                "rawValue": {
                                    "light": "hsla(28.82,52.7%,47.25%,1)",
                                    "dark": "hsla(28.82,52.7%,52.75%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-2-nature",
                                "name": "primary-l-2",
                                "raw": "var(--at-primary-l-2)",
                                "rawValue": {
                                    "light": "hsla(29.13,47.47%,57.45%,1)",
                                    "dark": "hsla(29.13,47.47%,42.55%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-3-nature",
                                "name": "primary-l-3",
                                "raw": "var(--at-primary-l-3)",
                                "rawValue": {
                                    "light": "hsla(28.86,47.88%,67.65%,1)",
                                    "dark": "hsla(28.86,47.88%,32.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-4-nature",
                                "name": "primary-l-4",
                                "raw": "var(--at-primary-l-4)",
                                "rawValue": {
                                    "light": "hsla(28.93,49.12%,77.65%,1)",
                                    "dark": "hsla(28.93,49.12%,22.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-5-nature",
                                "name": "primary-l-5",
                                "raw": "var(--at-primary-l-5)",
                                "rawValue": {
                                    "light": "hsla(30,51.61%,87.84%,1)",
                                    "dark": "hsla(30,51.61%,12.16%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-6-nature",
                                "name": "primary-l-6",
                                "raw": "var(--at-primary-l-6)",
                                "rawValue": {
                                    "light": "hsla(30,80%,98.04%,1)",
                                    "dark": "hsla(30,80%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-1-nature",
                                "name": "primary-d-1",
                                "raw": "var(--at-primary-d-1)",
                                "rawValue": {
                                    "light": "hsla(29.08,80.25%,31.76%,1)",
                                    "dark": "hsla(29.08,80.25%,68.24%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-2-nature",
                                "name": "primary-d-2",
                                "raw": "var(--at-primary-d-2)",
                                "rawValue": {
                                    "light": "hsla(28.6,79.26%,26.47%,1)",
                                    "dark": "hsla(28.6,79.26%,73.53%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-3-nature",
                                "name": "primary-d-3",
                                "raw": "var(--at-primary-d-3)",
                                "rawValue": {
                                    "light": "hsla(28.6,79.63%,21.18%,1)",
                                    "dark": "hsla(28.6,79.63%,78.82%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-4-nature",
                                "name": "primary-d-4",
                                "raw": "var(--at-primary-d-4)",
                                "rawValue": {
                                    "light": "hsla(29.06,80%,15.69%,1)",
                                    "dark": "hsla(29.06,80%,84.31%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-5-nature",
                                "name": "primary-d-5",
                                "raw": "var(--at-primary-d-5)",
                                "rawValue": {
                                    "light": "hsla(27.14,77.78%,10.59%,1)",
                                    "dark": "hsla(27.14,77.78%,89.41%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-6-nature",
                                "name": "primary-d-6",
                                "raw": "var(--at-primary-d-6)",
                                "rawValue": {
                                    "light": "hsla(27,76.92%,5.1%,1)",
                                    "dark": "hsla(27,76.92%,94.9%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-1-nature",
                                "name": "primary-t-1",
                                "raw": "var(--at-primary-t-1)",
                                "rawValue": {
                                    "light": "hsla(29.01,79.89%,37.06%,0.84)",
                                    "dark": "hsla(29.01,79.89%,62.94%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-2-nature",
                                "name": "primary-t-2",
                                "raw": "var(--at-primary-t-2)",
                                "rawValue": {
                                    "light": "hsla(29.01,79.89%,37.06%,0.68)",
                                    "dark": "hsla(29.01,79.89%,62.94%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-3-nature",
                                "name": "primary-t-3",
                                "raw": "var(--at-primary-t-3)",
                                "rawValue": {
                                    "light": "hsla(29.01,79.89%,37.06%,0.53)",
                                    "dark": "hsla(29.01,79.89%,62.94%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-4-nature",
                                "name": "primary-t-4",
                                "raw": "var(--at-primary-t-4)",
                                "rawValue": {
                                    "light": "hsla(29.01,79.89%,37.06%,0.37)",
                                    "dark": "hsla(29.01,79.89%,62.94%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-5-nature",
                                "name": "primary-t-5",
                                "raw": "var(--at-primary-t-5)",
                                "rawValue": {
                                    "light": "hsla(29.01,79.89%,37.06%,0.21)",
                                    "dark": "hsla(29.01,79.89%,62.94%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-6-nature",
                                "name": "primary-t-6",
                                "raw": "var(--at-primary-t-6)",
                                "rawValue": {
                                    "light": "hsla(29.01,79.89%,37.06%,0.05)",
                                    "dark": "hsla(29.01,79.89%,62.94%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-nature",
                                "name": "secondary",
                                "raw": "var(--at-secondary)",
                                "rawValue": {
                                    "light": "hsla(86, 68%, 37%, 1)",
                                    "dark": "hsla(86, 68%, 37%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_secondary-l-1-nature",
                                    "at_secondary-l-2-nature",
                                    "at_secondary-l-3-nature",
                                    "at_secondary-l-4-nature",
                                    "at_secondary-l-5-nature",
                                    "at_secondary-l-6-nature",
                                    "at_secondary-d-1-nature",
                                    "at_secondary-d-2-nature",
                                    "at_secondary-d-3-nature",
                                    "at_secondary-d-4-nature",
                                    "at_secondary-d-5-nature",
                                    "at_secondary-d-6-nature",
                                    "at_secondary-t-1-nature",
                                    "at_secondary-t-2-nature",
                                    "at_secondary-t-3-nature",
                                    "at_secondary-t-4-nature",
                                    "at_secondary-t-5-nature",
                                    "at_secondary-t-6-nature"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-1-nature",
                                "name": "secondary-l-1",
                                "raw": "var(--at-secondary-l-1)",
                                "rawValue": {
                                    "light": "hsla(85.87,45.23%,47.25%,1)",
                                    "dark": "hsla(85.87,45.23%,52.75%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-2-nature",
                                "name": "secondary-l-2",
                                "raw": "var(--at-secondary-l-2)",
                                "rawValue": {
                                    "light": "hsla(85.91,40.37%,57.25%,1)",
                                    "dark": "hsla(85.91,40.37%,42.75%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-3-nature",
                                "name": "secondary-l-3",
                                "raw": "var(--at-secondary-l-3)",
                                "rawValue": {
                                    "light": "hsla(85.59,40.96%,67.45%,1)",
                                    "dark": "hsla(85.59,40.96%,32.55%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-4-nature",
                                "name": "secondary-l-4",
                                "raw": "var(--at-secondary-l-4)",
                                "rawValue": {
                                    "light": "hsla(86.25,42.11%,77.65%,1)",
                                    "dark": "hsla(86.25,42.11%,22.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-5-nature",
                                "name": "secondary-l-5",
                                "raw": "var(--at-secondary-l-5)",
                                "rawValue": {
                                    "light": "hsla(84.44,42.86%,87.65%,1)",
                                    "dark": "hsla(84.44,42.86%,12.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-6-nature",
                                "name": "secondary-l-6",
                                "raw": "var(--at-secondary-l-6)",
                                "rawValue": {
                                    "light": "hsla(85.71,63.64%,97.84%,1)",
                                    "dark": "hsla(85.71,63.64%,2.16%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-1-nature",
                                "name": "secondary-d-1",
                                "raw": "var(--at-secondary-d-1)",
                                "rawValue": {
                                    "light": "hsla(86.18,67.9%,31.76%,1)",
                                    "dark": "hsla(86.18,67.9%,68.24%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-2-nature",
                                "name": "secondary-d-2",
                                "raw": "var(--at-secondary-d-2)",
                                "rawValue": {
                                    "light": "hsla(86.09,68.66%,26.27%,1)",
                                    "dark": "hsla(86.09,68.66%,73.73%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-3-nature",
                                "name": "secondary-d-3",
                                "raw": "var(--at-secondary-d-3)",
                                "rawValue": {
                                    "light": "hsla(85.48,68.22%,20.98%,1)",
                                    "dark": "hsla(85.48,68.22%,79.02%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-4-nature",
                                "name": "secondary-d-4",
                                "raw": "var(--at-secondary-d-4)",
                                "rawValue": {
                                    "light": "hsla(85.56,67.5%,15.69%,1)",
                                    "dark": "hsla(85.56,67.5%,84.31%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-5-nature",
                                "name": "secondary-d-5",
                                "raw": "var(--at-secondary-d-5)",
                                "rawValue": {
                                    "light": "hsla(85,69.23%,10.2%,1)",
                                    "dark": "hsla(85,69.23%,89.8%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-6-nature",
                                "name": "secondary-d-6",
                                "raw": "var(--at-secondary-d-6)",
                                "rawValue": {
                                    "light": "hsla(84.71,68%,4.9%,1)",
                                    "dark": "hsla(84.71,68%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-1-nature",
                                "name": "secondary-t-1",
                                "raw": "var(--at-secondary-t-1)",
                                "rawValue": {
                                    "light": "hsla(86.05,68.25%,37.06%,0.84)",
                                    "dark": "hsla(86.05,68.25%,62.94%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-2-nature",
                                "name": "secondary-t-2",
                                "raw": "var(--at-secondary-t-2)",
                                "rawValue": {
                                    "light": "hsla(86.05,68.25%,37.06%,0.68)",
                                    "dark": "hsla(86.05,68.25%,62.94%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-3-nature",
                                "name": "secondary-t-3",
                                "raw": "var(--at-secondary-t-3)",
                                "rawValue": {
                                    "light": "hsla(86.05,68.25%,37.06%,0.53)",
                                    "dark": "hsla(86.05,68.25%,62.94%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-4-nature",
                                "name": "secondary-t-4",
                                "raw": "var(--at-secondary-t-4)",
                                "rawValue": {
                                    "light": "hsla(86.05,68.25%,37.06%,0.37)",
                                    "dark": "hsla(86.05,68.25%,62.94%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-5-nature",
                                "name": "secondary-t-5",
                                "raw": "var(--at-secondary-t-5)",
                                "rawValue": {
                                    "light": "hsla(86.05,68.25%,37.06%,0.21)",
                                    "dark": "hsla(86.05,68.25%,62.94%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-6-nature",
                                "name": "secondary-t-6",
                                "raw": "var(--at-secondary-t-6)",
                                "rawValue": {
                                    "light": "hsla(86.05,68.25%,37.06%,0.05)",
                                    "dark": "hsla(86.05,68.25%,62.94%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-nature",
                                "name": "neutral",
                                "raw": "var(--at-neutral)",
                                "rawValue": {
                                    "light": "hsla(29, 20%, 50%, 1)",
                                    "dark": "hsla(29, 20%, 50%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_neutral-l-1-nature",
                                    "at_neutral-l-2-nature",
                                    "at_neutral-l-3-nature",
                                    "at_neutral-l-4-nature",
                                    "at_neutral-l-5-nature",
                                    "at_neutral-l-6-nature",
                                    "at_neutral-d-1-nature",
                                    "at_neutral-d-2-nature",
                                    "at_neutral-d-3-nature",
                                    "at_neutral-d-4-nature",
                                    "at_neutral-d-5-nature",
                                    "at_neutral-d-6-nature",
                                    "at_neutral-t-1-nature",
                                    "at_neutral-t-2-nature",
                                    "at_neutral-t-3-nature",
                                    "at_neutral-t-4-nature",
                                    "at_neutral-t-5-nature",
                                    "at_neutral-t-6-nature"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-1-nature",
                                "name": "neutral-l-1",
                                "raw": "var(--at-neutral-l-1)",
                                "rawValue": {
                                    "light": "hsla(30,19.63%,58.04%,1)",
                                    "dark": "hsla(30,19.63%,41.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-2-nature",
                                "name": "neutral-l-2",
                                "raw": "var(--at-neutral-l-2)",
                                "rawValue": {
                                    "light": "hsla(29.14,20.23%,66.08%,1)",
                                    "dark": "hsla(29.14,20.23%,33.92%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-3-nature",
                                "name": "neutral-l-3",
                                "raw": "var(--at-neutral-l-3)",
                                "rawValue": {
                                    "light": "hsla(30,19.7%,74.12%,1)",
                                    "dark": "hsla(30,19.7%,25.88%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-4-nature",
                                "name": "neutral-l-4",
                                "raw": "var(--at-neutral-l-4)",
                                "rawValue": {
                                    "light": "hsla(30,19.57%,81.96%,1)",
                                    "dark": "hsla(30,19.57%,18.04%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-5-nature",
                                "name": "neutral-l-5",
                                "raw": "var(--at-neutral-l-5)",
                                "rawValue": {
                                    "light": "hsla(30,20%,90.2%,1)",
                                    "dark": "hsla(30,20%,9.8%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-6-nature",
                                "name": "neutral-l-6",
                                "raw": "var(--at-neutral-l-6)",
                                "rawValue": {
                                    "light": "hsla(30,20%,98.04%,1)",
                                    "dark": "hsla(30,20%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-1-nature",
                                "name": "neutral-d-1",
                                "raw": "var(--at-neutral-d-1)",
                                "rawValue": {
                                    "light": "hsla(29.3,19.82%,42.55%,1)",
                                    "dark": "hsla(29.3,19.82%,57.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-2-nature",
                                "name": "neutral-d-2",
                                "raw": "var(--at-neutral-d-2)",
                                "rawValue": {
                                    "light": "hsla(30,20.22%,34.9%,1)",
                                    "dark": "hsla(30,20.22%,65.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-3-nature",
                                "name": "neutral-d-3",
                                "raw": "var(--at-neutral-d-3)",
                                "rawValue": {
                                    "light": "hsla(30,20%,27.45%,1)",
                                    "dark": "hsla(30,20%,72.55%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-4-nature",
                                "name": "neutral-d-4",
                                "raw": "var(--at-neutral-d-4)",
                                "rawValue": {
                                    "light": "hsla(30,19.61%,20%,1)",
                                    "dark": "hsla(30,19.61%,80%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-5-nature",
                                "name": "neutral-d-5",
                                "raw": "var(--at-neutral-d-5)",
                                "rawValue": {
                                    "light": "hsla(32.31,20.63%,12.35%,1)",
                                    "dark": "hsla(32.31,20.63%,87.65%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-6-nature",
                                "name": "neutral-d-6",
                                "raw": "var(--at-neutral-d-6)",
                                "rawValue": {
                                    "light": "hsla(36,20%,4.9%,1)",
                                    "dark": "hsla(36,20%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-1-nature",
                                "name": "neutral-t-1",
                                "raw": "var(--at-neutral-t-1)",
                                "rawValue": {
                                    "light": "hsla(29.41,20%,50%,0.84)",
                                    "dark": "hsla(29.41,20%,50%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-2-nature",
                                "name": "neutral-t-2",
                                "raw": "var(--at-neutral-t-2)",
                                "rawValue": {
                                    "light": "hsla(29.41,20%,50%,0.68)",
                                    "dark": "hsla(29.41,20%,50%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-3-nature",
                                "name": "neutral-t-3",
                                "raw": "var(--at-neutral-t-3)",
                                "rawValue": {
                                    "light": "hsla(29.41,20%,50%,0.53)",
                                    "dark": "hsla(29.41,20%,50%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-4-nature",
                                "name": "neutral-t-4",
                                "raw": "var(--at-neutral-t-4)",
                                "rawValue": {
                                    "light": "hsla(29.41,20%,50%,0.37)",
                                    "dark": "hsla(29.41,20%,50%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-5-nature",
                                "name": "neutral-t-5",
                                "raw": "var(--at-neutral-t-5)",
                                "rawValue": {
                                    "light": "hsla(29.41,20%,50%,0.21)",
                                    "dark": "hsla(29.41,20%,50%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-6-nature",
                                "name": "neutral-t-6",
                                "raw": "var(--at-neutral-t-6)",
                                "rawValue": {
                                    "light": "hsla(29.41,20%,50%,0.05)",
                                    "dark": "hsla(29.41,20%,50%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-nature",
                                "name": "black",
                                "raw": "var(--at-black)",
                                "rawValue": {
                                    "light": "hsla(0, 0%, 0%, 1)",
                                    "dark": "#ffffff"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_black-t-1-nature",
                                    "at_black-t-2-nature",
                                    "at_black-t-3-nature",
                                    "at_black-t-4-nature",
                                    "at_black-t-5-nature",
                                    "at_black-t-6-nature"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-1-nature",
                                "name": "black-t-1",
                                "raw": "var(--at-black-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.84)",
                                    "dark": "hsla(0,0%,100%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-2-nature",
                                "name": "black-t-2",
                                "raw": "var(--at-black-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.68)",
                                    "dark": "hsla(0,0%,100%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-3-nature",
                                "name": "black-t-3",
                                "raw": "var(--at-black-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.53)",
                                    "dark": "hsla(0,0%,100%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-4-nature",
                                "name": "black-t-4",
                                "raw": "var(--at-black-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.37)",
                                    "dark": "hsla(0,0%,100%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-5-nature",
                                "name": "black-t-5",
                                "raw": "var(--at-black-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.21)",
                                    "dark": "hsla(0,0%,100%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-6-nature",
                                "name": "black-t-6",
                                "raw": "var(--at-black-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.05)",
                                    "dark": "hsla(0,0%,100%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-nature",
                                "name": "white",
                                "raw": "var(--at-white)",
                                "rawValue": {
                                    "light": "#ffffff",
                                    "dark": "#000000"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_white-t-1-nature",
                                    "at_white-t-2-nature",
                                    "at_white-t-3-nature",
                                    "at_white-t-4-nature",
                                    "at_white-t-5-nature",
                                    "at_white-t-6-nature"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-1-nature",
                                "name": "white-t-1",
                                "raw": "var(--at-white-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.84)",
                                    "dark": "hsla(0,0%,0%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-nature",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-2-nature",
                                "name": "white-t-2",
                                "raw": "var(--at-white-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.68)",
                                    "dark": "hsla(0,0%,0%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-nature",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-3-nature",
                                "name": "white-t-3",
                                "raw": "var(--at-white-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.53)",
                                    "dark": "hsla(0,0%,0%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-nature",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-4-nature",
                                "name": "white-t-4",
                                "raw": "var(--at-white-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.37)",
                                    "dark": "hsla(0,0%,0%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-nature",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-5-nature",
                                "name": "white-t-5",
                                "raw": "var(--at-white-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.21)",
                                    "dark": "hsla(0,0%,0%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-nature",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-6-nature",
                                "name": "white-t-6",
                                "raw": "var(--at-white-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.05)",
                                    "dark": "hsla(0,0%,0%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-nature",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            }
                        ]
                    },
                    {
                        "id": "at_framework_palette_purple",
                        "name": "AT Purple",
                        "at_framework": true,
                        "at_version": "1.0.0",
                        "status": "disabled",
                        "prefix": "at-",
                        "defaultExpanded": true,
                        "colors": [
                            {
                                "id": "at_primary-purple",
                                "name": "primary",
                                "raw": "var(--at-primary)",
                                "rawValue": {
                                    "light": "hsla(301, 66.7%, 41.2%, 1)",
                                    "dark": "hsla(301, 66.7%, 41.2%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_primary-l-1-purple",
                                    "at_primary-l-2-purple",
                                    "at_primary-l-3-purple",
                                    "at_primary-l-4-purple",
                                    "at_primary-l-5-purple",
                                    "at_primary-l-6-purple",
                                    "at_primary-d-1-purple",
                                    "at_primary-d-2-purple",
                                    "at_primary-d-3-purple",
                                    "at_primary-d-4-purple",
                                    "at_primary-d-5-purple",
                                    "at_primary-d-6-purple",
                                    "at_primary-t-1-purple",
                                    "at_primary-t-2-purple",
                                    "at_primary-t-3-purple",
                                    "at_primary-t-4-purple",
                                    "at_primary-t-5-purple",
                                    "at_primary-t-6-purple"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-1-purple",
                                "name": "primary-l-1",
                                "raw": "var(--at-primary-l-1)",
                                "rawValue": {
                                    "light": "hsla(301.02,46.83%,50.59%,1)",
                                    "dark": "hsla(301.02,46.83%,49.41%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-2-purple",
                                "name": "primary-l-2",
                                "raw": "var(--at-primary-l-2)",
                                "rawValue": {
                                    "light": "hsla(300.63,46.8%,60.2%,1)",
                                    "dark": "hsla(300.63,46.8%,39.8%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-3-purple",
                                "name": "primary-l-3",
                                "raw": "var(--at-primary-l-3)",
                                "rawValue": {
                                    "light": "hsla(300.82,47.1%,69.61%,1)",
                                    "dark": "hsla(300.82,47.1%,30.39%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-4-purple",
                                "name": "primary-l-4",
                                "raw": "var(--at-primary-l-4)",
                                "rawValue": {
                                    "light": "hsla(301.18,47.66%,79.02%,1)",
                                    "dark": "hsla(301.18,47.66%,20.98%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-5-purple",
                                "name": "primary-l-5",
                                "raw": "var(--at-primary-l-5)",
                                "rawValue": {
                                    "light": "hsla(300,48.28%,88.63%,1)",
                                    "dark": "hsla(300,48.28%,11.37%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-l-6-purple",
                                "name": "primary-l-6",
                                "raw": "var(--at-primary-l-6)",
                                "rawValue": {
                                    "light": "hsla(300,60%,98.04%,1)",
                                    "dark": "hsla(300,60%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-1-purple",
                                "name": "primary-d-1",
                                "raw": "var(--at-primary-d-1)",
                                "rawValue": {
                                    "light": "hsla(300.5,66.48%,35.1%,1)",
                                    "dark": "hsla(300.5,66.48%,64.9%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-2-purple",
                                "name": "primary-d-2",
                                "raw": "var(--at-primary-d-2)",
                                "rawValue": {
                                    "light": "hsla(301.21,66.44%,29.22%,1)",
                                    "dark": "hsla(301.21,66.44%,70.78%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-3-purple",
                                "name": "primary-d-3",
                                "raw": "var(--at-primary-d-3)",
                                "rawValue": {
                                    "light": "hsla(300.77,66.1%,23.14%,1)",
                                    "dark": "hsla(300.77,66.1%,76.86%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-4-purple",
                                "name": "primary-d-4",
                                "raw": "var(--at-primary-d-4)",
                                "rawValue": {
                                    "light": "hsla(300,67.44%,16.86%,1)",
                                    "dark": "hsla(300,67.44%,83.14%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-5-purple",
                                "name": "primary-d-5",
                                "raw": "var(--at-primary-d-5)",
                                "rawValue": {
                                    "light": "hsla(301.58,67.86%,10.98%,1)",
                                    "dark": "hsla(301.58,67.86%,89.02%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-d-6-purple",
                                "name": "primary-d-6",
                                "raw": "var(--at-primary-d-6)",
                                "rawValue": {
                                    "light": "hsla(300,68%,4.9%,1)",
                                    "dark": "hsla(300,68%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-1-purple",
                                "name": "primary-t-1",
                                "raw": "var(--at-primary-t-1)",
                                "rawValue": {
                                    "light": "hsla(300.86,66.67%,41.18%,0.84)",
                                    "dark": "hsla(300.86,66.67%,58.82%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-2-purple",
                                "name": "primary-t-2",
                                "raw": "var(--at-primary-t-2)",
                                "rawValue": {
                                    "light": "hsla(300.86,66.67%,41.18%,0.68)",
                                    "dark": "hsla(300.86,66.67%,58.82%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-3-purple",
                                "name": "primary-t-3",
                                "raw": "var(--at-primary-t-3)",
                                "rawValue": {
                                    "light": "hsla(300.86,66.67%,41.18%,0.53)",
                                    "dark": "hsla(300.86,66.67%,58.82%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-4-purple",
                                "name": "primary-t-4",
                                "raw": "var(--at-primary-t-4)",
                                "rawValue": {
                                    "light": "hsla(300.86,66.67%,41.18%,0.37)",
                                    "dark": "hsla(300.86,66.67%,58.82%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-5-purple",
                                "name": "primary-t-5",
                                "raw": "var(--at-primary-t-5)",
                                "rawValue": {
                                    "light": "hsla(300.86,66.67%,41.18%,0.21)",
                                    "dark": "hsla(300.86,66.67%,58.82%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_primary-t-6-purple",
                                "name": "primary-t-6",
                                "raw": "var(--at-primary-t-6)",
                                "rawValue": {
                                    "light": "hsla(300.86,66.67%,41.18%,0.05)",
                                    "dark": "hsla(300.86,66.67%,58.82%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_primary-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-purple",
                                "name": "secondary",
                                "raw": "var(--at-secondary)",
                                "rawValue": {
                                    "light": "hsla(17, 68%, 37%, 1)",
                                    "dark": "hsla(17, 68%, 37%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_secondary-l-1-purple",
                                    "at_secondary-l-2-purple",
                                    "at_secondary-l-3-purple",
                                    "at_secondary-l-4-purple",
                                    "at_secondary-l-5-purple",
                                    "at_secondary-l-6-purple",
                                    "at_secondary-d-1-purple",
                                    "at_secondary-d-2-purple",
                                    "at_secondary-d-3-purple",
                                    "at_secondary-d-4-purple",
                                    "at_secondary-d-5-purple",
                                    "at_secondary-d-6-purple",
                                    "at_secondary-t-1-purple",
                                    "at_secondary-t-2-purple",
                                    "at_secondary-t-3-purple",
                                    "at_secondary-t-4-purple",
                                    "at_secondary-t-5-purple",
                                    "at_secondary-t-6-purple"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-1-purple",
                                "name": "secondary-l-1",
                                "raw": "var(--at-secondary-l-1)",
                                "rawValue": {
                                    "light": "hsla(17.06,45.23%,47.25%,1)",
                                    "dark": "hsla(17.06,45.23%,52.75%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-2-purple",
                                "name": "secondary-l-2",
                                "raw": "var(--at-secondary-l-2)",
                                "rawValue": {
                                    "light": "hsla(17.05,40.37%,57.25%,1)",
                                    "dark": "hsla(17.05,40.37%,42.75%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-3-purple",
                                "name": "secondary-l-3",
                                "raw": "var(--at-secondary-l-3)",
                                "rawValue": {
                                    "light": "hsla(17.65,40.96%,67.45%,1)",
                                    "dark": "hsla(17.65,40.96%,32.55%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-4-purple",
                                "name": "secondary-l-4",
                                "raw": "var(--at-secondary-l-4)",
                                "rawValue": {
                                    "light": "hsla(17.5,42.11%,77.65%,1)",
                                    "dark": "hsla(17.5,42.11%,22.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-5-purple",
                                "name": "secondary-l-5",
                                "raw": "var(--at-secondary-l-5)",
                                "rawValue": {
                                    "light": "hsla(17.78,42.86%,87.65%,1)",
                                    "dark": "hsla(17.78,42.86%,12.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-l-6-purple",
                                "name": "secondary-l-6",
                                "raw": "var(--at-secondary-l-6)",
                                "rawValue": {
                                    "light": "hsla(17.14,63.64%,97.84%,1)",
                                    "dark": "hsla(17.14,63.64%,2.16%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-1-purple",
                                "name": "secondary-d-1",
                                "raw": "var(--at-secondary-d-1)",
                                "rawValue": {
                                    "light": "hsla(16.91,67.9%,31.76%,1)",
                                    "dark": "hsla(16.91,67.9%,68.24%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-2-purple",
                                "name": "secondary-d-2",
                                "raw": "var(--at-secondary-d-2)",
                                "rawValue": {
                                    "light": "hsla(17.61,68.66%,26.27%,1)",
                                    "dark": "hsla(17.61,68.66%,73.73%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-3-purple",
                                "name": "secondary-d-3",
                                "raw": "var(--at-secondary-d-3)",
                                "rawValue": {
                                    "light": "hsla(17.26,68.22%,20.98%,1)",
                                    "dark": "hsla(17.26,68.22%,79.02%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-4-purple",
                                "name": "secondary-d-4",
                                "raw": "var(--at-secondary-d-4)",
                                "rawValue": {
                                    "light": "hsla(16.67,67.5%,15.69%,1)",
                                    "dark": "hsla(16.67,67.5%,84.31%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-5-purple",
                                "name": "secondary-d-5",
                                "raw": "var(--at-secondary-d-5)",
                                "rawValue": {
                                    "light": "hsla(18.33,69.23%,10.2%,1)",
                                    "dark": "hsla(18.33,69.23%,89.8%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-d-6-purple",
                                "name": "secondary-d-6",
                                "raw": "var(--at-secondary-d-6)",
                                "rawValue": {
                                    "light": "hsla(17.65,68%,4.9%,1)",
                                    "dark": "hsla(17.65,68%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-1-purple",
                                "name": "secondary-t-1",
                                "raw": "var(--at-secondary-t-1)",
                                "rawValue": {
                                    "light": "hsla(17.21,68.25%,37.06%,0.84)",
                                    "dark": "hsla(17.21,68.25%,62.94%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-2-purple",
                                "name": "secondary-t-2",
                                "raw": "var(--at-secondary-t-2)",
                                "rawValue": {
                                    "light": "hsla(17.21,68.25%,37.06%,0.68)",
                                    "dark": "hsla(17.21,68.25%,62.94%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-3-purple",
                                "name": "secondary-t-3",
                                "raw": "var(--at-secondary-t-3)",
                                "rawValue": {
                                    "light": "hsla(17.21,68.25%,37.06%,0.53)",
                                    "dark": "hsla(17.21,68.25%,62.94%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-4-purple",
                                "name": "secondary-t-4",
                                "raw": "var(--at-secondary-t-4)",
                                "rawValue": {
                                    "light": "hsla(17.21,68.25%,37.06%,0.37)",
                                    "dark": "hsla(17.21,68.25%,62.94%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-5-purple",
                                "name": "secondary-t-5",
                                "raw": "var(--at-secondary-t-5)",
                                "rawValue": {
                                    "light": "hsla(17.21,68.25%,37.06%,0.21)",
                                    "dark": "hsla(17.21,68.25%,62.94%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_secondary-t-6-purple",
                                "name": "secondary-t-6",
                                "raw": "var(--at-secondary-t-6)",
                                "rawValue": {
                                    "light": "hsla(17.21,68.25%,37.06%,0.05)",
                                    "dark": "hsla(17.21,68.25%,62.94%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_secondary-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-purple",
                                "name": "neutral",
                                "raw": "var(--at-neutral)",
                                "rawValue": {
                                    "light": "hsla(301, 12%, 50%, 1)",
                                    "dark": "hsla(301, 12%, 50%, 1)"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_neutral-l-1-purple",
                                    "at_neutral-l-2-purple",
                                    "at_neutral-l-3-purple",
                                    "at_neutral-l-4-purple",
                                    "at_neutral-l-5-purple",
                                    "at_neutral-l-6-purple",
                                    "at_neutral-d-1-purple",
                                    "at_neutral-d-2-purple",
                                    "at_neutral-d-3-purple",
                                    "at_neutral-d-4-purple",
                                    "at_neutral-d-5-purple",
                                    "at_neutral-d-6-purple",
                                    "at_neutral-t-1-purple",
                                    "at_neutral-t-2-purple",
                                    "at_neutral-t-3-purple",
                                    "at_neutral-t-4-purple",
                                    "at_neutral-t-5-purple",
                                    "at_neutral-t-6-purple"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-1-purple",
                                "name": "neutral-l-1",
                                "raw": "var(--at-neutral-l-1)",
                                "rawValue": {
                                    "light": "hsla(302.31,12.15%,58.04%,1)",
                                    "dark": "hsla(302.31,12.15%,41.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-2-purple",
                                "name": "neutral-l-2",
                                "raw": "var(--at-neutral-l-2)",
                                "rawValue": {
                                    "light": "hsla(302.86,12.14%,66.08%,1)",
                                    "dark": "hsla(302.86,12.14%,33.92%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-3-purple",
                                "name": "neutral-l-3",
                                "raw": "var(--at-neutral-l-3)",
                                "rawValue": {
                                    "light": "hsla(303.75,12.12%,74.12%,1)",
                                    "dark": "hsla(303.75,12.12%,25.88%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-4-purple",
                                "name": "neutral-l-4",
                                "raw": "var(--at-neutral-l-4)",
                                "rawValue": {
                                    "light": "hsla(305,13.04%,81.96%,1)",
                                    "dark": "hsla(305,13.04%,18.04%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-5-purple",
                                "name": "neutral-l-5",
                                "raw": "var(--at-neutral-l-5)",
                                "rawValue": {
                                    "light": "hsla(308.57,13.73%,90%,1)",
                                    "dark": "hsla(308.57,13.73%,10%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-l-6-purple",
                                "name": "neutral-l-6",
                                "raw": "var(--at-neutral-l-6)",
                                "rawValue": {
                                    "light": "hsla(330,20%,98.04%,1)",
                                    "dark": "hsla(330,20%,1.96%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Light",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-1-purple",
                                "name": "neutral-d-1",
                                "raw": "var(--at-neutral-d-1)",
                                "rawValue": {
                                    "light": "hsla(302.22,12.44%,42.55%,1)",
                                    "dark": "hsla(302.22,12.44%,57.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-2-purple",
                                "name": "neutral-d-2",
                                "raw": "var(--at-neutral-d-2)",
                                "rawValue": {
                                    "light": "hsla(302.73,12.36%,34.9%,1)",
                                    "dark": "hsla(302.73,12.36%,65.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-3-purple",
                                "name": "neutral-d-3",
                                "raw": "var(--at-neutral-d-3)",
                                "rawValue": {
                                    "light": "hsla(303.53,12.06%,27.65%,1)",
                                    "dark": "hsla(303.53,12.06%,72.35%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-4-purple",
                                "name": "neutral-d-4",
                                "raw": "var(--at-neutral-d-4)",
                                "rawValue": {
                                    "light": "hsla(300,11.76%,20%,1)",
                                    "dark": "hsla(300,11.76%,80%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-5-purple",
                                "name": "neutral-d-5",
                                "raw": "var(--at-neutral-d-5)",
                                "rawValue": {
                                    "light": "hsla(307.5,12.5%,12.55%,1)",
                                    "dark": "hsla(307.5,12.5%,87.45%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-d-6-purple",
                                "name": "neutral-d-6",
                                "raw": "var(--at-neutral-d-6)",
                                "rawValue": {
                                    "light": "hsla(300,12%,4.9%,1)",
                                    "dark": "hsla(300,12%,95.1%,1)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Dark",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-1-purple",
                                "name": "neutral-t-1",
                                "raw": "var(--at-neutral-t-1)",
                                "rawValue": {
                                    "light": "hsla(301.94,12.16%,50%,0.84)",
                                    "dark": "hsla(301.94,12.16%,50%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-2-purple",
                                "name": "neutral-t-2",
                                "raw": "var(--at-neutral-t-2)",
                                "rawValue": {
                                    "light": "hsla(301.94,12.16%,50%,0.68)",
                                    "dark": "hsla(301.94,12.16%,50%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-3-purple",
                                "name": "neutral-t-3",
                                "raw": "var(--at-neutral-t-3)",
                                "rawValue": {
                                    "light": "hsla(301.94,12.16%,50%,0.53)",
                                    "dark": "hsla(301.94,12.16%,50%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-4-purple",
                                "name": "neutral-t-4",
                                "raw": "var(--at-neutral-t-4)",
                                "rawValue": {
                                    "light": "hsla(301.94,12.16%,50%,0.37)",
                                    "dark": "hsla(301.94,12.16%,50%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-5-purple",
                                "name": "neutral-t-5",
                                "raw": "var(--at-neutral-t-5)",
                                "rawValue": {
                                    "light": "hsla(301.94,12.16%,50%,0.21)",
                                    "dark": "hsla(301.94,12.16%,50%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_neutral-t-6-purple",
                                "name": "neutral-t-6",
                                "raw": "var(--at-neutral-t-6)",
                                "rawValue": {
                                    "light": "hsla(301.94,12.16%,50%,0.05)",
                                    "dark": "hsla(301.94,12.16%,50%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_neutral-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-purple",
                                "name": "black",
                                "raw": "var(--at-black)",
                                "rawValue": {
                                    "light": "hsla(0, 0%, 0%, 1)",
                                    "dark": "#ffffff"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_black-t-1-purple",
                                    "at_black-t-2-purple",
                                    "at_black-t-3-purple",
                                    "at_black-t-4-purple",
                                    "at_black-t-5-purple",
                                    "at_black-t-6-purple"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-1-purple",
                                "name": "black-t-1",
                                "raw": "var(--at-black-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.84)",
                                    "dark": "hsla(0,0%,100%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-2-purple",
                                "name": "black-t-2",
                                "raw": "var(--at-black-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.68)",
                                    "dark": "hsla(0,0%,100%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-3-purple",
                                "name": "black-t-3",
                                "raw": "var(--at-black-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.53)",
                                    "dark": "hsla(0,0%,100%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-4-purple",
                                "name": "black-t-4",
                                "raw": "var(--at-black-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.37)",
                                    "dark": "hsla(0,0%,100%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-5-purple",
                                "name": "black-t-5",
                                "raw": "var(--at-black-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.21)",
                                    "dark": "hsla(0,0%,100%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_black-t-6-purple",
                                "name": "black-t-6",
                                "raw": "var(--at-black-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,0%,0.05)",
                                    "dark": "hsla(0,0%,100%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_black-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-purple",
                                "name": "white",
                                "raw": "var(--at-white)",
                                "rawValue": {
                                    "light": "#ffffff",
                                    "dark": "#000000"
                                },
                                "complementaryChildren": [],
                                "shadeChildren": [
                                    "at_white-t-1-purple",
                                    "at_white-t-2-purple",
                                    "at_white-t-3-purple",
                                    "at_white-t-4-purple",
                                    "at_white-t-5-purple",
                                    "at_white-t-6-purple"
                                ],
                                "isExpanded": false,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-1-purple",
                                "name": "white-t-1",
                                "raw": "var(--at-white-t-1)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.84)",
                                    "dark": "hsla(0,0%,0%,0.84)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-purple",
                                "shadeOrder": 0,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-2-purple",
                                "name": "white-t-2",
                                "raw": "var(--at-white-t-2)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.68)",
                                    "dark": "hsla(0,0%,0%,0.68)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-purple",
                                "shadeOrder": 1,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-3-purple",
                                "name": "white-t-3",
                                "raw": "var(--at-white-t-3)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.53)",
                                    "dark": "hsla(0,0%,0%,0.53)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-purple",
                                "shadeOrder": 2,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-4-purple",
                                "name": "white-t-4",
                                "raw": "var(--at-white-t-4)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.37)",
                                    "dark": "hsla(0,0%,0%,0.37)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-purple",
                                "shadeOrder": 3,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-5-purple",
                                "name": "white-t-5",
                                "raw": "var(--at-white-t-5)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.21)",
                                    "dark": "hsla(0,0%,0%,0.21)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-purple",
                                "shadeOrder": 4,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            },
                            {
                                "id": "at_white-t-6-purple",
                                "name": "white-t-6",
                                "raw": "var(--at-white-t-6)",
                                "rawValue": {
                                    "light": "hsla(0,0%,100%,0.05)",
                                    "dark": "hsla(0,0%,0%,0.05)"
                                },
                                "isShade": true,
                                "shadeMode": "auto",
                                "shadeType": "Transparent",
                                "shadeParent": "at_white-purple",
                                "shadeOrder": 5,
                                "at_framework": true,
                                "at_version": "1.0.0"
                            }
                        ]
                    }
                ]',
            "theme_settings" => '
                {
                    "at_framework": {
                        "label": "AT Framework",
                        "at_framework": true,
                        "at_version": "1.0.0",
                        "settings": {
                            "_custom": true,
                            "conditions": {
                                "conditions": [
                                    {
                                        "id": "nqprte",
                                        "main": "any"
                                    }
                                ]
                            },
                            "typography": {
                                "typographyHtml": "calc(var(--base-font) / 16 * 100%)",
                                "typographyBody": {
                                    "font-size": "var(--at-text--s)"
                                },
                                "typographyHeadingH1": {
                                    "font-size": "var(--at-heading--xl)"
                                },
                                "typographyHeadingH2": {
                                    "font-size": "var(--at-heading--l)"
                                },
                                "typographyHeadingH3": {
                                    "font-size": "var(--at-heading--m)"
                                },
                                "typographyHeadingH4": {
                                    "font-size": "var(--at-heading--s)"
                                },
                                "typographyHeadingH5": {
                                    "font-size": "var(--at-heading--xs)"
                                },
                                "typographyHeadingH6": {
                                    "font-size": "var(--at-heading--2xs)"
                                },
                                "focusOutline": "var(--at-focus-outline-width) solid var(--at-focus-outline-color)"
                            },
                            "section": {
                                "padding": {
                                    "top": "var(--at-section-padding-block)",
                                    "bottom": "var(--at-section-padding-block)",
                                    "right": "var(--at-gutter)",
                                    "left": "var(--at-gutter)"
                                },
                                "widthMax": "var(--at-section-max-width)",
                                "_rowGap": "var(--at-container-gap)"
                            },
                            "container": {
                                "width": "100%",
                                "widthMax": "var(--at-site-box-max-width)",
                                "_rowGap": "var(--at-content-gap)"
                            },
                            "block": {
                                "_rowGap": "var(--at-content-gap)",
                                "_columnGap": "var(--at-content-gap)"
                            },
                            "links": {
                                "typography": {
                                    "color": {
                                        "raw": "var(--at-link-color)"
                                    }
                                },
                                "typography:hover": {
                                    "color": {
                                        "raw": "var(--at-link-color--hover)"
                                    }
                                },
                                "typography:active": {
                                    "color": {
                                        "raw": "var(--at-link-color--active)"
                                    }
                                },
                                "cssSelectors": ":where(.brxe-accordion .accordion-content-wrapper) a, :where(.brxe-icon-box .content) a, :where(.brxe-list) a, :where(.brxe-post-content):not([data-source=bricks]) a, :where(.brxe-posts .dynamic p) a, :where(.brxe-shortcode) a, :where(.brxe-tabs .tab-content) a, :where(.brxe-team-members) .description a, :where(.brxe-testimonials) .testimonial-content-wrapper a, :where(.brxe-text) a, :where(a.brxe-text), :where(.brxe-text-basic) a, :where(a.brxe-text-basic), :where(.brxe-post-comments) .comment-content a, :where(.brxe-text-link)"
                            },
                            "general": {
                                "siteBackground": {
                                    "color": {
                                        "raw": "var(--at-white)"
                                    }
                                }
                            },
                            "heading": {
                                "tag": "h2"
                            },
                            "button": {
                                "background": {
                                    "raw": "var(--at-btn-primary-background)"
                                },
                                "background:hover": {
                                    "raw": "var(--at-btn-primary-background--hover)"
                                },
                                "border": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-border-color)"
                                    },
                                    "width": {
                                        "top": "var(--at-btn-border-width)",
                                        "bottom": "var(--at-btn-border-width)",
                                        "right": "var(--at-btn-border-width)",
                                        "left": "var(--at-btn-border-width)"
                                    },
                                    "radius": {
                                        "top": "var(--at-btn-border-radius)",
                                        "right": "var(--at-btn-border-radius)",
                                        "bottom": "var(--at-btn-border-radius)",
                                        "left": "var(--at-btn-border-radius)"
                                    },
                                    "style": "solid"
                                },
                                "border:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-border-color--hover)"
                                    },
                                    "width": {
                                        "top": "var(--at-btn-border-width--hover)",
                                        "bottom": "var(--at-btn-border-width--hover)",
                                        "right": "var(--at-btn-border-width--hover)",
                                        "left": "var(--at-btn-border-width--hover)"
                                    },
                                    "radius": {
                                        "top": "var(--at-btn-border-radius--hover)",
                                        "right": "var(--at-btn-border-radius--hover)",
                                        "bottom": "var(--at-btn-border-radius--hover)",
                                        "left": "var(--at-btn-border-radius--hover)"
                                    }
                                },
                                "boxShadow": {
                                    "color": {
                                        "raw": "var(--at-btn-shadow)"
                                    }        
                                },
                                "boxShadow:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-shadow--hover)"
                                    }        
                                },
                                "transition": "var(--at-btn-transition)",
                                "typography": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-color)"
                                    },
                                    "font-size": "var(--at-btn-medium-font-size)",
                                    "font-style": "normal",
                                    "font-weight": "600",
                                    "letter-spacing": "0.2",
                                    "line-height": "1",
                                    "text-align": "center",
                                    "text-decoration": "none",
                                    "text-transform": "uppercase",
                                    "text-wrap": "nowrap",
                                    "white-space": "nowrap"
                                },
                                "typography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-color--hover)"
                                    }
                                },
                                "outlineTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-color)"
                                    }
                                },
                                "outlineBackground": {
                                    "raw": "var(--at-btn-primary-outline-background)"
                                },
                                "outlineBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-border-color)"
                                    },
                                    "width": {
                                        "top": "var(--at-btn-outline-border-width)",
                                        "bottom": "var(--at-btn-outline-border-width)",
                                        "right": "var(--at-btn-outline-border-width)",
                                        "left": "var(--at-btn-outline-border-width)"
                                    },
                                    "radius": {
                                        "top": "var(--at-btn-outline-border-radius)",
                                        "right": "var(--at-btn-outline-border-radius)",
                                        "bottom": "var(--at-btn-outline-border-radius)",
                                        "left": "var(--at-btn-outline-border-radius)"
                                    }
                                },
                                "outlineBoxShadow": {
                                    "color": {
                                        "raw": "var(--at-btn-outline-shadow)"
                                    }        
                                },
                                "outlineBoxShadow:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-outline-shadow--hover)"
                                    }        
                                },
                                "outlineTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-color--hover)"
                                    }
                                },
                                "outlineBackground:hover": {
                                    "raw": "var(--at-btn-primary-outline-background--hover)"
                                },
                                "outlineBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-border-color--hover)"
                                    },
                                    "width": {
                                        "top": "var(--at-btn-outline-border-width--hover)",
                                        "bottom": "var(--at-btn-outline-border-width--hover)",
                                        "right": "var(--at-btn-outline-border-width--hover)",
                                        "left": "var(--at-btn-outline-border-width--hover)"
                                    }
                                },
                                "primaryTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-color)"
                                    }
                                },
                                "primaryBackground": {
                                    "raw": "var(--at-btn-primary-background)"
                                },
                                "primaryBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-border-color)"
                                    }
                                },
                                "primaryTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-color--hover)"
                                    }
                                },
                                "primaryBackground:hover": {
                                    "raw": "var(--at-btn-primary-background--hover)"
                                },
                                "primaryBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-border-color--hover)"
                                    }
                                },
                                "primaryOutlineTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-color)"
                                    }
                                },
                                "primaryOutlineBackground": {
                                    "raw": "var(--at-btn-primary-outline-background)"
                                },
                                "primaryOutlineBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-border-color)"
                                    }
                                },
                                "primaryOutlineTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-color--hover)"
                                    }
                                },
                                "primaryOutlineBackground:hover": {
                                    "raw": "var(--at-btn-primary-outline-background--hover)"
                                },
                                "primaryOutlineBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-primary-outline-border-color--hover)"
                                    }
                                },
                                "secondaryTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-color)"
                                    }
                                },
                                "secondaryBackground": {
                                    "raw": "var(--at-btn-secondary-background)"
                                },
                                "secondaryBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-border-color)"
                                    }
                                },
                                "secondaryTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-color--hover)"
                                    }
                                },
                                "secondaryBackground:hover": {
                                    "raw": "var(--at-btn-secondary-background--hover)"
                                },
                                "secondaryBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-border-color--hover)"
                                    }
                                },
                                "secondaryOutlineTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-outline-color)"
                                    }
                                },
                                "secondaryOutlineBackground": {
                                    "raw": "var(--at-btn-secondary-outline-background)"
                                },
                                "secondaryOutlineBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-outline-border-color)"
                                    }
                                },
                                "secondaryOutlineTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-outline-color--hover)"
                                    }
                                },
                                "secondaryOutlineBackground:hover": {
                                    "raw": "var(--at-btn-secondary-outline-background--hover)"
                                },
                                "secondaryOutlineBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-secondary-outline-border-color--hover)"
                                    }
                                },
                                "lightTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-light-color)"
                                    }
                                },
                                "lightBackground": {
                                    "raw": "var(--at-btn-light-background)"
                                },
                                "lightBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-light-border-color)"
                                    }
                                },
                                "lightTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-light-color--hover)"
                                    }
                                },
                                "lightBackground:hover": {
                                    "raw": "var(--at-btn-light-background--hover)"
                                },
                                "lightBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-light-border-color--hover)"
                                    }
                                },
                                "lightOutlineTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-light-outline-color)"
                                    }
                                },
                                "lightOutlineBackground": {
                                    "raw": "var(--at-btn-light-outline-background)"
                                },
                                "lightOutlineBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-light-outline-border-color)"
                                    }
                                },
                                "lightOutlineTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-light-outline-color--hover)"
                                    }
                                },
                                "lightOutlineBackground:hover": {
                                    "raw": "var(--at-btn-light-outline-background--hover)"
                                },
                                "lightOutlineBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-light-outline-border-color--hover)"
                                    }
                                },
                                "darkTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-color)"
                                    }
                                },
                                "darkBackground": {
                                    "raw": "var(--at-btn-dark-background)"
                                },
                                "darkBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-border-color)"
                                    }
                                },
                                "darkTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-color--hover)"
                                    }
                                },
                                "darkBackground:hover": {
                                    "raw": "var(--at-btn-dark-background--hover)"
                                },
                                "darkBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-border-color--hover)"
                                    }
                                },
                                "darkOutlineTypography": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-outline-color)"
                                    }
                                },
                                "darkOutlineBackground": {
                                    "raw": "var(--at-btn-dark-outline-background)"
                                },
                                "darkOutlineBorder": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-outline-border-color)"
                                    }
                                },
                                "darkOutlineTypography:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-outline-color--hover)"
                                    }
                                },
                                "darkOutlineBackground:hover": {
                                    "raw": "var(--at-btn-dark-outline-background--hover)"
                                },
                                "darkOutlineBorder:hover": {
                                    "color": {
                                        "raw": "var(--at-btn-dark-outline-border-color--hover)"
                                    }
                                },
                                "sizeDefaultPadding": {
                                    "bottom": "var(--at-btn-medium-padding-block)",
                                    "top": "var(--at-btn-medium-padding-block)",
                                    "right": "var(--at-btn-medium-padding-inline)",
                                    "left": "var(--at-btn-medium-padding-inline)"
                                },
                                "sizeSmPadding": {
                                    "top": "var(--at-btn-small-padding-block)",
                                    "right": "var(--at-btn-small-padding-inline)",
                                    "left": "var(--at-btn-small-padding-inline)",
                                    "bottom": "var(--at-btn-small-padding-block)"
                                },
                                "sizeSmTypography": {
                                    "font-size": "var(--at-btn-small-font-size)"
                                },
                                "sizeMdPadding": {
                                    "bottom": "var(--at-btn-medium-padding-block)",
                                    "top": "var(--at-btn-medium-padding-block)",
                                    "right": "var(--at-btn-medium-padding-inline)",
                                    "left": "var(--at-btn-medium-padding-inline)"
                                },
                                "sizeMdTypography": {
                                    "font-size": "var(--at-btn-medium-font-size)"
                                },
                                "sizeLgPadding": {
                                    "bottom": "var(--at-btn-large-padding-block)",
                                    "top": "var(--at-btn-large-padding-block)",
                                    "right": "var(--at-btn-large-padding-inline)",
                                    "left": "var(--at-btn-large-padding-inline)"
                                },
                                "sizeLgTypography": {
                                    "font-size": "var(--at-btn-large-font-size)"
                                },
                                "sizeXlPadding": {
                                    "bottom": "var(--at-btn-x-large-padding-block)",
                                    "top": "var(--at-btn-x-large-padding-block)",
                                    "right": "var(--at-btn-x-large-padding-inline)",
                                    "left": "var(--at-btn-x-large-padding-inline)"
                                },
                                "sizeXlTypography": {
                                    "font-size": "var(--at-btn-x-large-font-size)"
                                }
                            }
                        }
                    }
                }',
            "advanced_css" => '
                [
                    {
                        "id":"at_framework",
                        "file":false,
                        "label":"globals--v1.0.css",
                        "type":"css",
                        "typeLabel":"css",
                        "category":"at framework",
                        "scope":"global",
                        "message":"",
                        "readOnly":"",
                        "contentCss":"/****************\nWherever possible AT Framework variables and Classes are defined in the Bricks Class System.\nThis stylesheet is for any rules that we want to be always output, even if they are not added to a Bricks Elements.\n****************/\n\n/****************\nBRICKS OVERRIDES \n****************/\n\n/* fix P margins in Bricks Blocks */\n.brxe-block>p {\n  margin: 0;\n}\n\n/* ensure footer goes to bottom, even if there isn not enough content*/\nbody {\n  min-height: 100vh;\n  min-height: 100svh;\n  min-height: 100dvh;\n}\n\n/****************\nALTERNATE SECTION BACKGROUND\n\nAdd the classes to the page classes.\nApply to #brx-content > section elements\n****************/\n\n:where(.at-section--alt-odd #brx-content > section:nth-child(odd)) {\n  background: var(--at-section--alt-background);\n}\n\n:where(.at-section--alt-even #brx-content > section:nth-child(even)) {\n  background: var(--at-section--alt-background);\n}\n\n/****************\nSTICKY HEADERS\n\nSet a variable for the Bricks Header height.\nThis may be useful for when the headers are sticky.\n\nWe recommend keeping the varuable dymamic with JavaScript\n@see https://gist.github.com/wpeasy/66995b6b153edd8142dd4646df41cd19\nAdd this to your code manage and comment out below\n\nManually set the header height at different breakpoints.\nComment all of this out if you impliment the JavaScript linked above\n****************/\n\n@media(max-width: 477px) {\n  body {\n    --at-header-height: 150px;\n    /* Mobile - Measure and set manually */\n  }\n}\n\n@media(max-width: 766px) {\n  body {\n    --at-header-height: 150px;\n    /* Mobile Landscape - Measure and set manually */\n  }\n}\n\n@media(max-width: 990px) {\n  body {\n    --at-header-height: 150px;\n    /* Tablet Portrait - Measure and set manually */\n  }\n}\n\n@media(min-width: 991px) {\n  body {\n    --at-header-height: 150px;\n    /* Desktop and Above - Measure and set manually */\n  }\n}\n\n/***************\nA11y \n****************/\n\n/* focus offset styles */\nbody.bricks-is-frontend :focus-visible {\n  outline-offset: var(--at-focus-outline-offset);\n}\n\n/* reduced motion styles */\n@media (prefers-reduced-motion: reduce) {\n  * {\n    animation: none !important;\n    transition: none !important;\n    scroll-behavior: auto !important;\n  }\n\n  /* allow for transitions that fade in staring with low opacity */\n  [class*=fade-],\n  [class*=-fade] {\n    opacity: 1 !important;\n  }\n}",
                        "contentSass":"",
                        "order":5,
                        "status":"1",
                        "priority":"10",
                        "saveMethod":"ajax",
                        "toggleActive":true,
                        "enqueueFrontend":"1",
                        "enqueueBuilder":"1",
                        "enqueueGutenberg":"1",
                        "hasChanged": true,
                        "at_framework":true,
                        "at_version": "1.0.0"
                    },
                    {
                        "id":"at_framework_overrides",
                        "file":false,
                        "label":"overrides.css",
                        "type":"css",
                        "typeLabel":"css",
                        "category":"at framework",
                        "scope":"global",
                        "message":"",
                        "readOnly":"",
                        "contentCss":"/*******\n\nOverrides declared in this stylesheet won’t be overwritten during updates, so your custom styles are safe. This file can only be deleted manually and it’s disabled by default\n\n********/",
                        "contentSass":"",
                        "order":5,
                        "status":"0",
                        "priority":"10",
                        "saveMethod":"ajax",
                        "toggleActive":true,
                        "enqueueFrontend":"1",
                        "enqueueBuilder":"1",
                        "enqueueGutenberg":"1",
                        "hasChanged": true
                    }
                ]',
            "recipes" => '
                [
                    {
                        "id": "recipe-button",
                        "file": false,
                        "label": "button",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "/*\nButton overrides for variations\nDelete the variables you do not want to override\nSet the values you want. \n*/\n\n%root%.bricks-button.bricks-button,\n%root% .bricks-button.bricks-button{\n    /* Global properties */\n    --at-btn-border-radius: var(--at-radius--s);\n    --at-btn-border-radius--hover: var(--at-btn-border-radius);  \n    --at-btn-border-width: 2px;\n    --at-btn-border-width--hover: var(--at-btn-border-width);\n    --at-btn-shadow: none;\n    --at-btn-shadow--hover: var(--at-btn-shadow--l);\n    --at-btn-transition: all var(--at-duration--fast) ease;\n    /* Outline properties */\n    --at-btn-outline-border-radius: var(--at-radius--s);\n    --at-btn-outilne-border-radius--hover: var(--at-btn-border-radius);  \n    --at-btn-outline-border-width: 2px;\n    --at-btn-outline-border-width--hover: var(--at-btn-border-width);\n    --at-btn-outline-shadow: none;\n    --at-btn-outline-shadow--hover: var(--at-btn-shadow--l);\n    /* Variant properties - Primary Color example */\n    --at-btn-primary-color: var(--at-primary-l-6);\n    --at-btn-primary-color--hover: var(--at-primary-l-6);\n    --at-btn-primary-background: var(--at-primary);\n    --at-btn-primary-background--hover: var(--at-primary-d-1);\n    --at-btn-primary-border-color: var(--at-primary);\n    --at-btn-primary-border-color--hover: var(--at-primary-d-1);\n    /* Variant properties - Outline example */\n    --at-btn-primary-outline-color: var(--at-primary);\n    --at-btn-primary-outline-color--hover: var(--at-primary-d-1);\n    --at-btn-primary-outline-background: rgba(0,0,0,0);\n    --at-btn-primary-outline-background--hover: rgba(0,0,0,0)\n    --at-btn-primary-outline-border-color: var(--at-primary);\n    --at-btn-primary-outline-border-color--hover: var(--at-primary-d-1);\n    /* Variant properties - Medium Size example */\n    --at-btn-medium-font-size: var(--at-text--s);\n    --at-btn-medium-padding-block: .5em;\n    --at-btn-medium-padding-inline: 1em;\n    /* The following properties have no corresponding variables and need to be overwritten the hard way */\n    font-style: normal;\n    font-weight: 600;\n    letter-spacing: 0.2px;\n    line-height: 1;\n    text-align: center;\n    text-decoration: none;\n    text-transform: uppercase;\n    text-wrap: nowrap;\n    white-space: nowrap;\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-colorset",
                        "file": false,
                        "label": "colorset",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "%root% {\n  --text-color: var(--at-neutral-d-5);\n  --background: var(--at-neutral-l-5);\n  --heading-color: var(--at-neutral-d-6);\n  \n  --link-color:  var(--at-link-color);\n  --link-color--hover: var(--at-link-color--hover);\n  --link-color--active: var(--at-link-color--active);\n  \n  --header-wrapper-color: var(--at-neutral-d-6);\n  --header-wrapper-background: var(--at-black-t-5);\n\n  --body-wrapper-color: var(--at-neutral-l-5);\n  --body-wrapper-background: var(--at-black-t-5);\n\n  --footer-wrapper-color: var(--at-neutral-d-6);\n  --footer-wrapper-background: var(--at-black-t-5);\n\n  --media-wrapper-color: var(--at-neutral-d-6);\n  --media-wrapper-background: var(--at-black-t-5);\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-line-clamp",
                        "file": false,
                        "label": "line-clamp",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "%root%{\\n  --lines: 1;\\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-ul-svg-icon",
                        "file": false,
                        "label": "ul-svg-icon",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "%root%{\\n  --item-gap:  0.25em;\\n  --font-size: var(--at-text--s);\\n  --icon-gap: 0.5em;\\n\\t--image-mask: var(--at-svg--arrow);\\n  --icon-color: var(--at-primary);\\n  --icon-offset: 0.3em;\\n  --icon-size: 1.2em;\\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-mark",
                        "file": false,
                        "label": "mark",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "%root%{\\n  --color: var(--at-mark-color);\\n  --line-height: var(--at-mark-line-height);\\n  --padding: var(--at-mark-padding);  \\n  --text-shadow: var(--at-mark-text-shadow);\\n  --font-size: var(--at-mark-font-size);\\n  --font-weight: var(--at-mark-font-weight);\\n  --text-transform: var(--at-mark-text-transform);\\n  --letter-spacing: var(--at-mark-letter-spacing);\\n  --transform: var(--at-mark-transform);\\n  \\n  --background: var(--background, var(--at-mark-background));\\n  --box-shadow: var(--at-mark-shadow);\\n  --border: var(--at-mark-border-width) solid var(--at-mark-border-color);\\n  --border-radius: var(--at-mark-border-radius);\\n  --background-transform: var(--at-mark-background-transform);\\n  --inset-block, var(--at-mark-inset-block);\\n  --inset-inline, var(--at-mark-inset-inline);\\n}\\n",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-media-bp-up",
                        "file": false,
                        "label": "media-bp-up",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "@media(min-width: 768px){\\n  %root%{\\n    color: red; /* your rules */\\n  }\\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-media-bp-down",
                        "file": false,
                        "label": "media-bp-down",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "@media(max-width: 767px){\\n  %root%{\\n    color: red; /* your rules */\\n  }\\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-container-wrapper",
                        "file": false,
                        "label": "container-wrapper",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "%root% {\\n\\tcontainer-type: inline-size;\\n  container-name: your-container-name;\\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-container-query",
                        "file": false,
                        "label": "container-query",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "/* Now use a container query */\\n@container your-container-name (min-width: 400px) {\\n  %root%{\\n    color: red; /* your rules */\\n  }\\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    },
                    {
                        "id": "recipe-sticky-header-height",
                        "file": false,
                        "label": "sticky-header-height",
                        "type": "css",
                        "typeLabel": "recipe",
                        "category": "at framework",
                        "message": "",
                        "readOnly": false,
                        "contentCss": "/*******\\nSTICKY HEADERS\\n\\nSet out header height variable based on the viewport width\\n\\nRECOMMENDATION: \\nComment out the following media queries. Use the JavaScript found here https://gist.github.com/wpeasy/66995b6b153edd8142dd4646df41cd19\\n\\nBy using JS the header height is measured constantly as the screen with changes. This is more accurate that just changing it manually at breakpoints.\\n\\n********/\\n\\n:root{ --at-header-height: 200px; /* default for 991 and above */ }\\n@media(max-width: 467px){\\n  :root{ --at-header-height: 200px; /* measure manually */}\\n}\\n@media(max-width: 776px){\\n  :root{ --at-header-height: 200px; /* measure manually */}\\n}\\n@media(max-width: 990px){\\n  :root{ --at-header-height: 200px; /* measure manually */}\\n}\\n\\n/* If the Header is sticky, add extra padding to the first content section */\\n#brx-header.sticky:not(.on-scroll) ~ #brx-content > *:first-of-type{\\n  padding-block-start: calc(var(--at-section-padding-block) + var(--at-header-height));\\n}",
                        "status": "1",
                        "saveMethod": "ajax",
                        "toggleActive": true,
                        "hasChanged": true,
                        "at_framework": "true",
                        "at_version": "1.0.0"
                    }
                ]'
        ]
    ];
}