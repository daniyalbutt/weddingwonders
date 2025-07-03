<!DOCTYPE html>
<html class="sticky_menu">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <link rel="icon" type="image/x-icon" href="{{ asset('img/logo-icon.png') }}">
        <title>{{ $data->name }} | {{ config('app.name', 'Laravel') }}</title>
        <link href="http://fonts.googleapis.com/css?family=PT+Sans" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,500,900" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="{{ asset('portfolio/css/theme.css') }}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{ asset('portfolio/css/responsive.css') }}" type="text/css" media="all" />
        <link rel="stylesheet" href="{{ asset('portfolio/css/custom.css') }}" type="text/css" media="all" />
        <script type="text/javascript" src="{{ asset('portfolio/js/jquery.min.js') }}"></script>
    </head>
    <body>
        <div class="main_wrapper">
            <div class="content_wrapper">
                <div class="container simple-post-container">
                    <div class="content_block no-sidebar row">
                        <div class="fl-container ">
                            <div class="row">
                                <div class="posts-block simple-post">
                                    <div class="contentarea">
                                        <div class="row">
                                            <div class="span12 module_cont module_blog module_none_padding module_blog_page">
                                                <div class="blog_post_page sp_post">
                                                    <div class="pf_output_container">
                                                        <div class="slider-wrapper theme-default ">
                                                            <div class="nivoSlider">                                                
                                                                <img src="{{ asset($data->image) }}" alt="{{ $data->name }}" />
                                                                @foreach($data->images as $key => $value)
                                                                <img src="{{ asset($value->image) }}" alt="{{ $data->name }}" />
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="blogpreview_top">
                                                        <div class="box_date">
                                                            <span class="box_month">{{ \Carbon\Carbon::parse($data->event_date)->format('F') }}</span>
                                                            <span class="box_day">{{ \Carbon\Carbon::parse($data->event_date)->format('d') }}</span>
                                                        </div>
                                                        <div class="listing_meta">
                                                            <span>in <a href="javascript:void(0)">{{ $data->venue }}</a></span>
                                                        </div>
                                                        <div class="author_ava"><img alt="" src="{{ asset('img/logo.png') }}" class="avatar" height="72" width="72" /></div>
                                                    </div>
                                                    <h3 class="blogpost_title">{{ $data->name }}</h3>
                                                </div>
                                                <!--.blog_post_page -->
                                                <div class="blog_post_content">
                                                    <article class="contentarea sp_contentarea">
                                                        <div class="row">
                                                            <div class="span12 first-module module_number_1 module_cont pb20 module_text_area">
                                                                <div class="module_content">
                                                                    <p>{{ $data->theme }}</p>
                                                                </div>
                                                            </div>
                                                            <!-- .module_cont -->
                                                        </div>
                                                        <div class="row">
                                                            <div class="span12 module_number_2 module_cont pb20 module_gallery">
                                                                <div class="list-of-images images_in_a_row_3">
                                                                    <div class="gallery_item">
                                                                        <div class="gallery_item_padding">
                                                                            <div class="gallery_item_wrapper">
                                                                                <a href="{{ asset($data->image) }}" class="prettyPhoto" data-rel="prettyPhoto[gallery1]" title="{{ $data->name }}">
                                                                                    <img class="gallery-stand-img" src="{{ asset($data->image) }}" alt="{{ $data->name }}" width="570" height="401">
                                                                                    <span class="gallery_fadder"></span>
                                                                                    <span class="gallery_ico"><i class="stand_icon icon-eye"></i></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @foreach($data->images as $key => $value)
                                                                    <div class="gallery_item">
                                                                        <div class="gallery_item_padding">
                                                                            <div class="gallery_item_wrapper">
                                                                                <a href="{{ asset($value->image) }}" class="prettyPhoto" data-rel="prettyPhoto[gallery1]" title="{{ $data->name }}">
                                                                                    <img class="gallery-stand-img" src="{{ asset($value->image) }}" alt="{{ $data->name }}" width="570" height="401">
                                                                                    <span class="gallery_fadder"></span>
                                                                                    <span class="gallery_ico"><i class="stand_icon icon-eye"></i></span>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    @endforeach
                                                                    <div class="clear"></div>
                                                                </div>
                                                            </div>
                                                            <!-- .module_cont -->
                                                        </div>
                                                    </article>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="single_hr">
                                    </div>
                                    <!-- .contentarea -->
                                </div>
                            </div>
                            <div class="clear"></div>
                        </div>
                        <!-- .fl-container -->
                        <div class="clear"></div>
                    </div>
                </div>
                <!-- .container -->
            </div>
            <!-- .content_wrapper -->
        </div>
        <!-- .main_wrapper -->
        <div class="content_bg"></div>
        <script type="text/javascript" src="{{ asset('portfolio/js/jquery-ui.min.js') }}"></script>    
        <script type="text/javascript" src="{{ asset('portfolio/js/modules.js') }}"></script>
        <script type="text/javascript" src="{{ asset('portfolio/js/theme.js') }}"></script> 
        <script>
            jQuery(document).ready(function(){
            	"use strict";			
            	jQuery('.commentlist').find('li').each(function(){
            		if (jQuery(this).find('ul').size() > 0) {
            			jQuery(this).addClass('has_ul');
            		}
            	});
            	jQuery('.form-allowed-tags').width(jQuery('#commentform').width() - jQuery('.form-submit').width() - 13);
            	
            	jQuery('.pf_output_container').each(function(){
            		if (jQuery(this).html() == '') {
            			jQuery(this).parents('.blog_post_page').addClass('no_pf');
            		} else {
            			jQuery(this).parents('.blog_post_page').addClass('has_pf');
            		}
            	});			
            				
            });
            jQuery(window).resize(function(){
            	"use strict";
            	jQuery('.form-allowed-tags').width(jQuery('#commentform').width() - jQuery('.form-submit').width() - 13);
            });
        </script>
    </body>
</html>