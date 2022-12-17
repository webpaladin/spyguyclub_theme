( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;

    blocks.registerBlockType( 'spyguy/emptyblock', {
        title: 'Empty div',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'Empty div block',
        example: {
        },
        attributes: {
            templatelock: {
                type:'string',
                default: false
            },
            allowedblocks: {
                type:'array',
                default: ''
            }
        },
        edit: function(props) {
            var attributes = props.attributes;
            return [

            el( 'div', { 
                className: props.className,
            },
            
            el(InnerBlocks, {
                templateLock: attributes.templatelock,
                allowedBlocks: attributes.allowedblocks
            }),

            )
            ]
        },
        save: function(props) {
            return el( 'div', { 
                className:props.className
            },
            
            el( InnerBlocks.Content )
            )

            
        },
    } );
}(
    window.wp.blocks,
    window.wp.components,
    window.wp.element,
    window.wp.editor,
    ) );