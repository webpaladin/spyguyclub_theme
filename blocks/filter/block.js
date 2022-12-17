( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { SelectControl } = components;

    blocks.registerBlockType( 'spyguy/filter', {
        title: 'Filter block',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'filter',
        example: {
        },
        attributes: {
            category: {
                type:'string',
                default: ''
            },
            device: {
                type:'string',
                default: ''
            },
            os: {
                type:'string',
                default: ''
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            return [

            el( 'div', { 
                className: props.className,
            },

            el( SelectControl,
            {
                label: 'Category',
                options : object_menu.software_category,
                onChange: ( value ) => {
                    props.setAttributes( { category: value } );
                },
                value: props.attributes.category,
                selected: props.attributes.category,
            }
            ),

            el( SelectControl,
            {
                label: 'Device',
                options : object_menu.software_device,
                onChange: ( value ) => {
                    props.setAttributes( { device: value } );
                },
                value: props.attributes.device,
                selected: props.attributes.device,
            }
            ),

            el( SelectControl,
            {
                label: 'Os',
                options : object_menu.software_os,
                onChange: ( value ) => {
                    props.setAttributes( { os: value } );
                },
                value: props.attributes.os,
                selected: props.attributes.os,
            }
            ),


            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:props.className
            },
            el('div', {className:'blockforfilter'},

                )
            )
        },
    } );
}(
    window.wp.blocks,
    window.wp.components,
    window.wp.element,
    window.wp.editor,
    ) );