( function( blocks, components, element, editor ) {
    var el = element.createElement;
    const { InnerBlocks } = wp.blockEditor;
    const { TextControl } = components;

    const ALLOWED_BLOCKS = [ 'spyguy/howtostartsitem' ];
    const BLOCKS_THEMPLATE = [ ['spyguy/howtostartsitem',{}] ];

    const ITEM_THEMPLATE = [ ['core/paragraph',{}] ];

    blocks.registerBlockType( 'spyguy/howtostartsitem', {
        title: 'howtostartsitem',
        icon: 'editor-table',
        category: 'spyguy-blocks-secondary',
        description: 'howtostartsitem',
        example: {
        },
        attributes: {
            title: {
                type:'string',
                default: ''
            },
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

            el('label', {},'Text'),

            el(InnerBlocks, {
                template: ITEM_THEMPLATE,
            }),

            )
            ]
        },
        save: function(props) {
            var attributes = props.attributes;
            return el( 'div', { 
                className:props.className
            },
            el('h4',{},attributes.title),
            el( InnerBlocks.Content )
            )
        },
    } );

    blocks.registerBlockType( 'spyguy/howtostart', {
        title: 'How to start',
        icon: 'editor-table',
        category: 'spyguy-blocks',
        description: 'howtostart',
        example: {
        },
        attributes: {
            subtitle: {
                type:'string',
                default: 'How to start'
            },
            blocktitle: {
                type:'string',
                default: ''
            },
        },
        edit: function(props) {
            var attributes = props.attributes;
            return [

            el( 'div', { 
                className: props.className,
            },

            el( TextControl,
            {
                label: 'subtitle',
                onChange: ( value ) => {
                    props.setAttributes( { subtitle: value } );
                },
                value: props.attributes.subtitle
            }
            ),

            el( TextControl,
            {
                label: 'Block title',
                onChange: ( value ) => {
                    props.setAttributes( { blocktitle: value } );
                },
                value: props.attributes.blocktitle
            }
            ),

            el(InnerBlocks, {
                allowedBlocks:ALLOWED_BLOCKS,
                template: BLOCKS_THEMPLATE,
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
                el('p',{className:'subtitle'},attributes.subtitle),
                el('h2',{},attributes.blocktitle),
                el('div',{className:'items-block'},
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