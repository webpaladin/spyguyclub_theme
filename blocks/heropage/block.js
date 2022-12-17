( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;
    const { TextControl } = components;
    var MediaUpload = wp.blockEditor.MediaUpload;
    var Button = components.Button;


    blocks.registerBlockType( 'spyguy/heropage', {
        title: 'Page hero',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'page hero',
        example: {
        },
        attributes: {
            title: {
                type:'string',
                default: ''
            },
            mediaID: {
                type: 'number',
                default: ''
            },
            mediaURL: {
                type: 'string',
                default: ''
            },
            mediaTitle: {
                type: 'string',
                default: ''
            },
            mediaAlt: {
                type: 'string',
                default: ''
            },

        },
        edit: function(props) {
            var attributes = props.attributes;
            var onSelectImage = function( media ) {
                return props.setAttributes( {
                    mediaURL: media.url,
                    mediaID: media.id,
                    mediaTitle: media.title,
                    mediaAlt: media.alt,
                } );
            };
            var deleteImg = function( event ){
                event.stopPropagation();
                return props.setAttributes( {
                    mediaURL: '',
                    mediaID: '',
                    mediaTitle: '',
                    mediaAlt: '',
                } );
            }

            return [

            el( 'div', { 
                className: props.className,
            },

            el( MediaUpload, {
                onSelect: onSelectImage,
                type: 'image',
                value: attributes.mediaID,
                render: function( obj ) {
                    return [ 
                    el( Button, {
                        className: attributes.mediaID ? 'image-button' : 'button button-large',
                        onClick: obj.open
                    },
                    ! attributes.mediaID ? 'Upload Image' : "\u270E"),
                    ! attributes.mediaID ? '' : el(Button, {className: 'delete-img', onClick: deleteImg}, "\xD7"),
                    el( 'img', { 
                        src: attributes.mediaURL,

                    } ),
                    ]
                }
            } ),


            el( TextControl,
            {
                label: 'Title',
                onChange: ( value ) => {
                    props.setAttributes( { title: value } );
                },
                value: props.attributes.title
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

            
            el(InnerBlocks, {}),

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
                    el('div',{className:'header'},
                        el('div',{className:'image'},
                            el('img',{
                                src: attributes.mediaURL,
                                alt: attributes.mediaAlt,
                                title: attributes.mediaTitle
                            }),
                            ),
                        (attributes.title) ? (
                            el('h1',{},attributes.title)
                            ) : (''),
                        ),
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