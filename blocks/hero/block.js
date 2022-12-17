( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;
    const { TextControl } = components;

    blocks.registerBlockType( 'spyguy/hero', {
        title: 'Home hero',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'Home hero',
        example: {
        },
        attributes: {
            title: {
                type:'string',
                default: ''
            },
            subtitle: {
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

            el( TextControl,
            {
                label: 'Title',
                onChange: ( value ) => {
                    props.setAttributes( { title: value } );
                },
                value: props.attributes.title
            }
            ),

            el( TextControl,
            {
                label: 'Sub title',
                onChange: ( value ) => {
                    props.setAttributes( { subtitle: value } );
                },
                value: props.attributes.subtitle
            }
            ),

            el( 'label', {
                className: 'blocks-base-control__label',
                style: {
                    width: '100%',
                    display: 'block',
                    fontSize: '13px'
                }
            }, 'Content:'),

            
            el(InnerBlocks, {
            }),

            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:props.className
            },
            el('div', {className:'container'},
                el('div',{className:'text'},
                    (attributes.title) ? (
                        el('h1',{},attributes.title)
                        ) : (''),
                    (attributes.subtitle) ? (
                        el('p',{className:'subtitle'},attributes.subtitle)
                        ) : (''),
                    el( InnerBlocks.Content )
                    )
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