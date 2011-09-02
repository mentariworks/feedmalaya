var Local = {
    
    cache       : {
        data    : {},
        hash    : '',
        uri     : ''
    },

    setBaseURI  : function(uri) {
        uri = uri.toString();
        this.cache.uri = uri;
        return true;
    },
    
    /**
     * We need to initiate this on each page load
     *
     * @alias __construct
     */
    initiate: function() {
        this.cache.doc = $(document);
    },

    request: function(curl, object, dataType) {
        if (object == undefined || curl == undefined) {
            Local.progress(true);
            return ;
        }
        
        if (dataType == undefined) {
            dataType = 'json';
        }
        
        request = curl.split(' ');
        var type = 'GET';
        var uri = '';
        
        var types = ['POST', 'GET', 'PUT', 'DELETE'];
        
        if (request.length == 1) {
            uri = curl;
        }
        else {
            request[0] = request[0];
            if ($.inArray(request[0], types) >= 0) {
                type = request[0];
            }
            
            uri = request[1];
        }
        
        var id = '#' + $(object).attr('id');
        
        
        $.ajax({
            'type': type,
            'dataType': dataType,
            'url': uri,
            'data': $(object).serialize(),
            'complete': function(xhr) {
                var data = Local.getJSON(xhr.responseText);
                
                var default_text = 'Invalid request';
                
                if (!(data == null || data.text == null)) {
                    default_text = data.text.toString();
                }
                
                Local.progress(true);

                switch (xhr.status) {
                    case 200:
                        var delayed = false;
                        if (data.text != null) {
                            Local.alert({
                                message: data.text, 
                                status: 'success', 
                                target: id
                            });
                            delayed = true;
                        }

                        if (data.redirect !== undefined) {
                            if (delayed) {
                                setTimeout(function() {
                                    window.location.href = data.redirect;
                                }, 4000);
                            }
                            else {
                                window.location.href = data.redirect;
                            }
                            
                        }
                        
                        if (data.reset !== undefined && data.reset === true) {
                            $(':input', object)
                            .not(':button, :submit, :reset, :hidden')
                            .val('')
                            .removeAttr('checked')
                            .removeAttr('selected');
                        }
                    break;
                    
                    default:
                        Local.alert({
                            message: default_text, 
                            status: 'error', 
                            target: id
                        });
                    break;
                }
            }
        });
    },

    /**
     * Ensure return data is actually an JSON Object
     *
     * @param object data
     */
    getJSON: function(data) {
        if (typeof data == 'string') {
            data = $.parseJSON(data);
        }
        
        return data;
    },

    /**
     * Clear <div id='content'>
     *
     */
    clear: function() {
        return this.cache.content.empty();
    },

    /**
     * Show 'loading' bar, if the param is set as true to hide it
     *
     * @param boolean method
     */
    progress: function(method) {
    },
    
    alert:function(message, status, target) {
        if (message.message !== undefined) {
            var status = message.status;
            var target = message.target;
            message = message.message; 
        }
    }
}