(function($) {
    "use strict";
    $.storage = new $.store();
    $.slider = {
        options: {},
        // last list view user has visited: {title: "...", hash: "..."}
        lastView: null,
        init: function(options) {
            var that = this;
            that.options = options;
            if (typeof ($.History) != "undefined") {
                $.History.bind(function() {
                    that.dispatch();
                });
            }
            $.wa.errorHandler = function(xhr) {
                if ((xhr.status === 403) || (xhr.status === 404)) {
                    var text = $(xhr.responseText);
                    if (text.find('.dialog-content').length) {
                        text = $('<div class="block double-padded"></div>').append(text.find('.dialog-content *'));

                    } else {
                        text = $('<div class="block double-padded"></div>').append(text.find(':not(style)'));
                    }
                    $("#slider-content").empty().append(text);
                    that.onPageNotFound();
                    return false;
                }
                return true;
            };
            var hash = this.getHash();
            if (hash === '#/' || !hash) {
                this.dispatch();
            } else {
                $.wa.setHash(hash);
            }
            this.lastView = $.storage.get('shop/customers/lastview') || {
                title: '',
                hash: ''
            };
            
            
        },
        // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
        // *   Dispatch-related
        // * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *

        // if this is > 0 then this.dispatch() decrements it and ignores a call
        skipDispatch: 0,
        /** Cancel the next n automatic dispatches when window.location.hash changes */
        stopDispatch: function(n) {
            this.skipDispatch = n;
        },
        /** Force reload current hash-based 'page'. */
        redispatch: function() {
            this.currentHash = null;
            this.dispatch();
        },
        /**
         * Called automatically when window.location.hash changes.
         * Call a corresponding handler by concatenating leading non-int parts of hash,
         * e.g. for #/aaa/bbb/111/dd/12/ee/ff
         * a method $.slider.AaaBbbAction('111', 'dd', '12', 'ee', 'ff') will be called.
         */
        dispatch: function(hash) {
            if (this.skipDispatch > 0) {
                this.skipDispatch--;
                return false;
            }

            if (hash === undefined || hash === null) {
                hash = this.getHash();
            }
            if (this.currentHash == hash) {
                return;
            }

            this.currentHash = hash;
            hash = hash.replace('#/', '');

            if (hash) {
                hash = hash.split('/');
                if (hash[0]) {
                    var actionName = "";
                    var attrMarker = hash.length;
                    for (var i = 0; i < hash.length; i++) {
                        var h = hash[i];
                        if (i < 2) {
                            if (i === 0) {
                                actionName = h;
                            } else if (parseInt(h, 10) != h && h.indexOf('=') == -1) {
                                actionName += h.substr(0, 1).toUpperCase() + h.substr(1);
                            } else {
                                attrMarker = i;
                                break;
                            }
                        } else {
                            attrMarker = i;
                            break;
                        }
                    }
                    var attr = hash.slice(attrMarker);
                    this.preExecute(actionName);
                    if (typeof (this[actionName + 'Action']) == 'function') {
                        $.shop.trace('$.slider.dispatch', [actionName + 'Action', attr]);
                        this[actionName + 'Action'].apply(this, attr);
                    } else {
                        $.shop.error('Invalid action name:', actionName + 'Action');
                    }
                    this.postExecute(actionName);
                } else {
                    this.preExecute();
                    this.defaultAction();
                    this.postExecute();
                }
            } else {
                this.preExecute();
                this.defaultAction();
                this.postExecute();
            }


        },
        preExecute: function(actionName, attr) {
        },
        postExecute: function(actionName, attr) {
            this.actionName = actionName;
        },
        defaultAction: function() {
            this.load('?plugin=slider&action=sliders',function(){
                $.slider.deleteSlidersInit();
                $.slider.selectAllInit();
            });
        },
        
        selectAllInit: function() {
            $('.slider-select-all').click(function(){
                if($(this).attr('checked')) {
                    $('.select-slider-checkbox').attr('checked','checked');
                } else {
                    $('.select-slider-checkbox').removeAttr('checked');
                }
            });
        },
        addsliderAction: function(id) {
           
            if(!id) {
                id = '';
            }
            this.load('?plugin=slider&action=addslider&id='+id,function(){
                $('#form-add-slider').submit(function() {
                    $.slider.saveHandler(this);
                    return false;
                });
                $('.add-slide-but').click($.slider.addSlide);
                $.slider.fileUploadInit();
                $.slider.deleteSlideInit();
                $('.slider-slide-form').submit(function() {
                    $.slider.saveSlideHandler(this);
                    return false;
                });
            }); 
        },
        
        addSlide: function() {
            var options = {content: $('.slider-slide-content')};
            var slider_id = $('#slider_id').val();
            var url = '?plugin=slider&action=addslide&slider_id=' + slider_id;
       
            $('.slider-slide-content').append('<div class="loading"><i class="icon16 loading"></i>Loading...</div>');
            return  $.get(url, function(result) {
                $('.loading').remove();         
                $('.slider-slide-content').append(result);
                $.slider.fileUploadInit();
                $.slider.deleteSlideInit();

                $('.slider-slide-form').submit(function() {
                    $.slider.saveSlideHandler(this);
                    return false;
                });
            });
        },
        
        fileUploadInit: function()
        {
            $('.fileupload').fileupload({
                    url: '?plugin=slider&action=saveslide',
                    dataType: 'json',
                
                    done: function (e, data) {  
                        $(this).parent().find('.slide-result').html('');                       
                        $('.loading').remove();
                        if(data.result.data) {
                            $(this).closest('.value').find(".preview").html('<img src="'+data.result.data.preview+'" />');
                            if(data.result.data.id) {
                                $(this).closest('.slider-slide-form').find(".slide_id").val(data.result.data.id);
                            }
                            
                        } else {
                            $.slider.message(data.result,{content: $(this).parent().find('.slide-result')});
                        }
                    },        
                    fail: function (e, data) {     
                        $('.loading').remove();
                        $.slider.message(data.result,{content: $(this).parent().find('.slide-result')});
                    },
                    start: function (e, data) { 
                            $(this).parent().append('<span class="loading"><i class="icon16 loading"></i>Loading...</span>');
                    },
                });  
        },
        
        
        deleteSlidersInit: function()
        {
            $('.delete-sliders-but').click(function(){
                    var $form = $('.sliders-form');  
                    $.ajax({
                        type: 'POST',
                        url: $form.attr('action'),
                        data: $form.serializeArray(),
                        dataType: 'json',
                        success: function(data, textStatus, jqXHR) {
                            
                            $.slider.message(data,{content: $('.del-sliders-result')});
                            if(data.status=='ok') {
                                $.slider.defaultAction();
                            }
                        },
                        error: function(jqXHR, errorText) {
                        }
                    });
                });
        },
        deleteSlideInit: function()
        {
            $('.delete-slide-but').click(function(){
                    var $form = $(this).closest('.slider-slide-form');
                    var slide_id = $form.find('.slide_id').val();
                    
                    $.ajax({
                        type: 'POST',
                        url: '?plugin=slider&action=deleteslide',
                        data: {slide_id: slide_id},
                        dataType: 'json',
                        success: function(data, textStatus, jqXHR) {
                            if(data.status=='ok') {
                                $form.remove();
                            } else if(data.status=='fail'){
                                $.slider.message(data,{content: $form.find('.del-slide-result')});
                            }
                        },
                        error: function(jqXHR, errorText) {
                        }
                    });
                });
        },

        saveSlideHandler: function(form)
        {
            var $form = $(form);
            $.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serializeArray(),
                iframe: true,
                dataType: 'json',
                success: function(data, textStatus, jqXHR) {
                    $.slider.message(data,{content: $form.find('.form-result')});
                    if(data.data && data.data.id) {
                        $form.find('.slide_id').val(data.data.id);
                    }
                    

                },
                error: function(jqXHR, errorText) {
                }
            });
        },
        saveHandler: function(form)
        {
            var $form = $(form);
            $.ajax({
                type: 'POST',
                url: $form.attr('action'),
                data: $form.serializeArray(),
                iframe: true,
                dataType: 'json',
                success: function(data, textStatus, jqXHR) {
                    $.slider.message(data);
                    if(data.data && data.data.id) {
                        $('#slider_id').val(data.data.id);
                    }
                    

                },
                error: function(jqXHR, errorText) {
                }
            });
        },
        message: function(data, options)
        {
            options = options || {};
            
            if(data.status == 'ok') {
                var mes = 'Сохранено';
                if(data.data.message) {
                    mes = data.data.message;
                    (options.content || $('#form-result')).css('color','green');
                }
                (options.content || $('#form-result')).html('<i class="icon16 yes" style="vertical-align:middle"></i>'+mes);
            } else if(data.status == 'fail') {
                var mes = 'Ошибка';
                if(data.errors) {
                    mes = data.errors[0][0];
                }
                (options.content || $('#form-result')).html('<i class="icon16 no" style="vertical-align:middle"></i>'+mes);
                (options.content || $('#form-result')).css('color','red');
            }
            (options.content || $('#form-result')).show();
            setTimeout('$("#form-result").hide()',5000);
        },
        /** Current hash */
        getHash: function() {
            return this.cleanHash();
        },
        /** Make sure hash has a # in the begining and exactly one / at the end.
         * For empty hashes (including #, #/, #// etc.) return an empty string.
         * Otherwise, return the cleaned hash.
         * When hash is not specified, current hash is used. */
        cleanHash: function(hash) {
            if (typeof hash == 'undefined') {
                hash = window.location.hash.toString();
            }

            if (!hash.length) {
                hash = '' + hash;
            }
            while (hash.length > 0 && hash[hash.length - 1] === '/') {
                hash = hash.substr(0, hash.length - 1);
            }
            hash += '/';

            if (hash[0] != '#') {
                if (hash[0] != '/') {
                    hash = '/' + hash;
                }
                hash = '#' + hash;
            } else if (hash[1] && hash[1] != '/') {
                hash = '#/' + hash.substr(1);
            }

            if (hash == '#/') {
                return '';
            }

            return hash;
        },
        load: function(url, options, fn) {
            if (typeof options === 'function') {
                fn = options;
                options = {};
            } else {
                options = options || {};
            }
            var r = Math.random();
            this.random = r;
            var self = this;
            
            
            
            (options.content || $("#slider-content")).html('<div class="block triple-padded"><i class="icon16 loading"></i>Loading...</div>');
            return  $.get(url, function(result) {
                if ((typeof options.check === 'undefined' || options.check) && self.random != r) {
                    // too late: user clicked something else.
                    return;
                }
                
                (options.content || $("#slider-content")).removeClass('bordered-left').html(result);
                if (typeof fn === 'function') {
                    fn.call(this);
                }
         
            });
        },
        onPageNotFound: function() {
            //this.defaultAction();
        }
    };



})(jQuery);