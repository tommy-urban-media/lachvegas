var wppx_imgs = {};
var wppx_selected = new Array();
var wppx_opened = false;
var wppx_current = '';
var wppx_width_small = '630px';
var wppx_width_big = '930px';
var wppx_height = '580px';

jQuery( document ).ready( function( jQuery ) {
	jQuery( '.wppx_loading_text' ).hide();

	jQuery( 'body' ).on( 'click', '#wppx_search', function() {
		wppx_search( 1 );
	} );

	jQuery( 'body' ).on( 'click', '.wppx_btn', function() {
		var editor_id = jQuery( this ).attr( 'data-editor' );
		jQuery( '#wppx_editor_id' ).val( editor_id );

		if ( wppx_opened ) {
			jQuery.colorbox( {
				width: wppx_width_big,
				height: wppx_height,
				inline: true,
				href: "#wppx_area",
				scrolling: false,
				fixed: true
			} );
		} else {
			jQuery.colorbox( {
				width: wppx_width_small,
				height: wppx_height,
				inline: true,
				href: "#wppx_area",
				scrolling: false,
				fixed: true
			} );
		}
	} );

	jQuery( 'body' ).on( 'change', '#wppx_page-select', function() {
		wppx_search( jQuery( this ).val() );
	} );

	jQuery( 'body' ).on( 'click', '#wppx_insert', function() {
		for ( var i = 0; i < wppx_selected.length; i ++ ) {
			var insert = '';
			var align = '';
			var align_class = '';
			var editor_id = jQuery( '#wppx_editor_id' ).val();
			if ( jQuery( '#wppx_align' ).val() != '' ) {
				align = ' align="' + wppx_escape_html( jQuery( '#wppx_align' ).val() ) + '"';
				align_class = ' class="' + wppx_escape_html( jQuery( '#wppx_align' ).val() ) + '"';
			}
			var cid = wppx_selected[i];
			if ( wppx_imgs[cid].img_caption != '' ) {
				insert = '[caption id="" ' + align + ']';
			}
			if ( jQuery( '#wppx_link' ).val() == 1 ) {
				insert += '<a href="' + wppx_escape_html( wppx_imgs[cid].img_site ) + '" title="' + wppx_escape_html( wppx_imgs[cid].img_title ) + '"';
			}
			if ( jQuery( '#wppx_link' ).val() == 2 ) {
				insert += '<a href="' + wppx_escape_html( wppx_imgs[cid].img_full ) + '" title="' + wppx_escape_html( wppx_imgs[cid].img_title ) + '"';
			}
			if ( (
				     jQuery( '#wppx_link' ).val() != 0
			     ) && jQuery( '#wppx_blank' ).is( ':checked' ) ) {
				insert += ' target="_blank"';
			}
			if ( (
				     jQuery( '#wppx_link' ).val() != 0
			     ) && jQuery( '#wppx_nofollow' ).is( ':checked' ) ) {
				insert += ' rel="nofollow"';
			}
			if ( jQuery( '#wppx_link' ).val() != 0 ) {
				insert += '>';
			}
			insert += '<img ' + align_class + ' src="' + wppx_escape_html( wppx_imgs[cid].img_full ) + '" width="' + wppx_escape_html( wppx_imgs[cid].img_width.toString() ) + '" height="' + wppx_escape_html( wppx_imgs[cid].img_height.toString() ) + '" title="' + wppx_escape_html( wppx_imgs[cid].img_title ) + '" alt="' + wppx_escape_html( wppx_imgs[cid].img_title ) + '"/>';
			if ( jQuery( '#wppx_link' ).val() != 0 ) {
				insert += '</a>';
			}
			if ( wppx_imgs[cid].img_caption != '' ) {
				insert += ' ' + wppx_escape_html( wppx_imgs[cid].img_caption ) + '[/caption]';
			}
			insert += '\n';
			if ( ! tinyMCE.activeEditor || tinyMCE.activeEditor.isHidden() ) {
				wppx_insert_caret( editor_id, insert );
			} else {
				tinyMCE.activeEditor.execCommand( 'mceInsertContent', 0, insert );
			}
		}
		jQuery.colorbox.close();
	} );

	jQuery( 'body' ).on( 'click', '#wppx_featured', function() {
		var url = jQuery( '#wppx_url' ).val();
		var title = jQuery( '#wppx_title' ).val();
		var caption = jQuery( '#wppx_caption' ).val();

		jQuery( '.wppx_featured_url' ).val( url );
		jQuery( '.wppx_featured_title' ).val( title );
		jQuery( '.wppx_featured_caption' ).val( caption );

		//fix for pixabay
		jQuery( '.wppb_featured_url' ).val( url );
		jQuery( '.wppb_featured_title' ).val( title );
		jQuery( '.wppb_featured_caption' ).val( caption );

		jQuery( '#postimagediv div.inside img' ).remove();
		jQuery( '#postimagediv div.inside' ).prepend( '<img src="' + url + '" width="270"/>' );
		jQuery.colorbox.close();
	} );

	jQuery( 'body' ).on( 'click', '#remove-post-thumbnail', function() {
		jQuery( '.wppx_featured_url' ).val( '' );
		//fix for pixabay
		jQuery( '.wppb_featured_url' ).val( '' );
	} );

	jQuery( 'body' ).on( 'click', '.wppx_item_overlay', function( event ) {
		var checkbox = jQuery( this ).parent().find( ':checkbox' );
		var checkbox_id = jQuery( this ).attr( 'rel' );

		jQuery.colorbox.resize( {width: wppx_width_big, height: wppx_height} );
		wppx_opened = true;
		wppx_current = checkbox_id;

		if ( event.ctrlKey ) {

			if ( ! checkbox.is( ':checked' ) ) {
				wppx_selected.push( checkbox_id );
			} else {
				wppx_selected.splice( wppx_selected.indexOf( checkbox_id ), 1 );
			}

			checkbox.attr( 'checked', ! checkbox.is( ':checked' ) );
		} else {
			if ( ! checkbox.is( ':checked' ) ) {
				wppx_selected = [checkbox_id];
				jQuery( '#wppx_area' ).find( 'input:checkbox' ).removeAttr( 'checked' );
				checkbox.attr( 'checked', ! checkbox.is( ':checked' ) );
			}
		}
		jQuery( '#wppx_title' ).val( wppx_imgs[checkbox_id].img_title );
		jQuery( '#wppx_caption' ).val( wppx_imgs[checkbox_id].img_caption );
		jQuery( '#wppx_width' ).val( wppx_imgs[checkbox_id].img_width );
		jQuery( '#wppx_height' ).val( wppx_imgs[checkbox_id].img_height );
		jQuery( '#wppx_site' ).val( wppx_imgs[checkbox_id].img_site );
		jQuery( '#wppx_url' ).val( wppx_imgs[checkbox_id].img_full );
		jQuery( '#wppx_view' ).html( '<img src="' + wppx_imgs[checkbox_id].img_full + '"/>' );
		jQuery( '#wppx_error' ).html( '' );

		jQuery( '#wppx_insert span' ).html( '(' + wppx_selected.length + ')' );
		jQuery( '#wppx_save span' ).html( '(' + wppx_selected.length + ')' );
		jQuery( '#wppx_save_only span' ).html( ' (' + wppx_selected.length + ')' );
	} );

	jQuery( 'body' ).on( 'change', '#wppx_title', function() {
		wppx_change_value( wppx_current, 'img_title', jQuery( this ).val() );
	} );

	jQuery( 'body' ).on( 'change', '#wppx_caption', function() {
		wppx_change_value( wppx_current, 'img_caption', jQuery( this ).val() );
	} );

	jQuery( 'body' ).on( 'change', '#wppx_width', function() {
		wppx_change_value( wppx_current, 'img_width', jQuery( this ).val() );
	} );

	jQuery( 'body' ).on( 'change', '#wppx_height', function() {
		wppx_change_value( wppx_current, 'img_height', jQuery( this ).val() );
	} );
} );

function wppx_search( page ) {
	jQuery( '#wppx_search' ).addClass( 'loading' );
	jQuery( '#wppx_container' ).html( '' );
	jQuery( '#wppx_page' ).html( '' );
	var data = {
		action: 'wppx_search',
		key: jQuery( '#wppx_input' ).val(),
		page: page,
		wppx_nonce: wppx_vars.wppx_nonce
	};
	jQuery.ajax( {
		method: 'POST',
		url: wppx_vars.wppx_ajax_url,
		data: data,
		success: function( response ) {
			wppx_show_images( JSON.parse( response ), page );
		},
		error: function() {
			console.log( 'error' );
		},
	} );
}

function wppx_show_images( data, page ) {
	jQuery( '#wppx_search' ).removeClass( 'loading' );
	if ( data.photos != 'undefined' ) {
		for ( var i = 0; i < data.photos.length; i ++ ) {
			var img_id = '';
			var img_title = '';
			if ( data.photos[i].id != undefined ) {
				img_id = data.photos[i].id;
			} else {
				img_id = data.photos[i].id;
			}
			var img_ext = data.photos[i].src.original.split( '.' ).pop().toUpperCase().substring( 0, 4 );
			var img_site = data.photos[i].url;
			var img_thumb = data.photos[i].src.tiny;
			var img_full = data.photos[i].src.original;
			var img_width = data.photos[i].width;
			var img_height = data.photos[i].height;
			if ( data.photos[i].photographer != undefined ) {
				img_title = String( data.photos[i].photographer );
			} else {
				img_title = img_id;
			}
			jQuery( '#wppx_container' ).append( '<div class="wppx_item" bg="' + img_thumb + '"><div class="wppx_item_overlay" rel="' + img_id + '"></div><div class="wppx_check"><input type="checkbox" value="' + img_id + '"/></div><span>' +
			                                    img_ext + ' | ' + img_width + 'x' + img_height + '</span></div>'
			);
			wppx_imgs[img_id] = {
				img_ext: img_ext,
				img_site: img_site,
				img_thumb: img_thumb,
				img_full: img_full,
				img_width: img_width,
				img_height: img_height,
				img_title: img_title,
				img_caption: ''
			};
		}
		jQuery( '.wppx_item' ).each( function() {
			var bg_url = jQuery( this ).attr( 'bg' );
			jQuery( this ).css( 'background-image', 'url(' + bg_url + ')' );
		} );
	}
	if ( data.total_results != 'undefined' ) {
		var pages = 'About ' + data.total_results + ' results / Pages: ';
		var per_page = 12;
		if ( data.total_results / per_page > 1 ) {
			pages += '<select id="wppx_page-select" class="wppx_page-select">';
			for ( var j = 1; j < data.total_results / per_page + 1; j ++ ) {
				pages += '<option value="' + j + '"';
				if ( j == page ) {
					pages += ' selected';
				}
				pages += '>' + j + '</option> ';
			}
			pages += '</select>';
		}
		jQuery( '#wppx_page' ).html( pages );
	}
}

function wppx_is_url( str ) {
	var pattern = new RegExp( '^(https?:\\/\\/)?' + // protocol
	                          '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|' + // domain name
	                          '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
	                          '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
	                          '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
	                          '(\\#[-a-z\\d_]*)?$', 'i' ); // fragment locator
	return pattern.test( str );
}

function wppx_change_value( img_id, img_field, img_value ) {
	wppx_imgs[img_id][img_field] = img_value;
}

function wppx_insert_caret( areaId, text ) {
	var thisArea = document.getElementById( areaId );
	var scrollPos = thisArea.scrollTop;
	var strPos = 0;
	var br = (
		(
			thisArea.selectionStart || thisArea.selectionStart == '0'
		) ?
			"ff" : (
				document.selection ? "ie" : false
			)
	);
	if ( br == "ie" ) {
		thisArea.focus();
		var range = document.selection.createRange();
		range.moveStart( 'character', - thisArea.value.length );
		strPos = range.text.length;
	}
	else if ( br == "ff" ) {
		strPos = thisArea.selectionStart;
	}

	var front = (
		thisArea.value
	).substring( 0, strPos );
	var back = (
		thisArea.value
	).substring( strPos, thisArea.value.length );
	thisArea.value = front + text + back;
	strPos = strPos + text.length;
	if ( br == "ie" ) {
		thisArea.focus();
		var range = document.selection.createRange();
		range.moveStart( 'character', - thisArea.value.length );
		range.moveStart( 'character', strPos );
		range.moveEnd( 'character', 0 );
		range.select();
	}
	else if ( br == "ff" ) {
		thisArea.selectionStart = strPos;
		thisArea.selectionEnd = strPos;
		thisArea.focus();
	}
	thisArea.scrollTop = scrollPos;
}

function wppx_escape_html( html ) {
	var fn = function( tag ) {
		var charsToReplace = {
			'&': '&amp;',
			'<': '&lt;',
			'>': '&gt;',
			'"': '&#34;'
		};
		return charsToReplace[tag] || tag;
	}
	if ( typeof html !== 'string' ) {
		return '';
	} else {
		return html.replace( /[&<>"]/g, fn );
	}
}