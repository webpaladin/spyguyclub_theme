( function( blocks, components, i18n, element, editor, compose ) {
    var el = element.createElement;
    var RichText = wp.blockEditor.RichText;
    const { TextControl, PanelBody, ToggleControl } = components;
    const { Fragment } = element;
    var InspectorControls = wp.blockEditor.InspectorControls;
    const { CheckboxControl } = components;

    blocks.registerBlockType( 'spyguy/quality', {
        title: 'Pros und Cons',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'Pros und Cons',
        example: {
        },
        attributes: {
            vorteile: {
                type: 'array',
                source: 'children',
                selector: 'ul',
            },
            nachteile: {
                type: 'array',
                source: 'children',
                selector: 'ul',
            },
            vortitle: {
                type: 'string',
                default: 'Pros:'
            },
            nachtitle: {
                type: 'string',
                default: 'Cons:'
            },
            rightBlockChecker: {
                type: Boolean,
                default: false
            },
            toggle: {
                type: Boolean,
                default: true
            },
            toggle2: {
                type: Boolean,
                default: true
            },

        },
        edit: function(props) {
            var attributes = props.attributes;

            return [

            el( Fragment, {},
                el( InspectorControls, {},
                    el( PanelBody, { title: 'Settings', initialOpen: true },

                        el( CheckboxControl, {
                            label:"Swap",
                            value: props.attributes.rightBlockChecker,
                            checked: props.attributes.rightBlockChecker,
                            onChange: ( value ) => {
                                props.setAttributes( { rightBlockChecker: value } );
                            }
                        }
                        ),


                        ),
                    ),
                ),

            el( 'div', { 
                className: (props.attributes.rightBlockChecker == true) ? (props.className+' swap') : props.className,

            },

            el('div',{className:'pros'},

                el( TextControl,
                {
                    label: 'Title',
                    onChange: ( value ) => {
                        props.setAttributes( { vortitle: value } );
                    },
                    value: props.attributes.vortitle
                }
                ),

                el(RichText,
                {
                    tagName: 'ul',
                    onChange: ( value ) => {
                        props.setAttributes( { vorteile: value } );
                    },
                    value: attributes.vorteile,
                    multiline:'li',
                }
                ),

                el(
                    ToggleControl,
                    {
                        label: 'Show',
                        checked: props.attributes.toggle,
                        onChange: ( value ) => {
                            props.setAttributes( { toggle: value } );
                        },
                    }
                    )

                ),

            
            el('div',{className:'cons'},
                el( TextControl,
                {
                    label: 'Title',
                    onChange: ( value ) => {
                        props.setAttributes( { nachtitle: value } );
                    },
                    value: props.attributes.nachtitle
                }
                ),

                el(RichText,
                {
                    tagName: 'ul',
                    onChange: ( value ) => {
                        props.setAttributes( { nachteile: value } );
                    },
                    value: attributes.nachteile,
                    multiline:'li',
                }
                ),

                el(
                    ToggleControl,
                    {
                        label: 'Show',
                        checked: props.attributes.toggle2,
                        onChange: ( value ) => {
                            props.setAttributes( { toggle2: value } );
                        },
                    }
                    )

                ),


            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:(props.attributes.rightBlockChecker == true) ? 'swap' : props.className,

            },

            (props.attributes.toggle == true) ? (
            
            el('div',{className:'pros'},
                el('p',{},attributes.vortitle),
                el( RichText.Content, {
                    tagName: 'ul',
                    value: attributes.vorteile,
                } ),
                )
            ):(''),

            (props.attributes.toggle2 == true) ? (
            el('div',{className:'cons'},
                el('p',{},attributes.nachtitle),
                el( RichText.Content, {
                    tagName: 'ul',
                    value: attributes.nachteile,
                } )
                )
            ):(''),
            )

            
        },
    } );
}(
    window.wp.blocks,
    window.wp.components,
    window.wp.i18n,
    window.wp.element,
    window.wp.editor,
    window.wp.compose
    ) );