(function ($) {

    var app = $.sammy('#main', function () {

        this.use('Template');
        this.get('#/form/:id', function () {

            var id = this.params['id'];

            std = new Std();
            config = new Config();
            $.each(std.getData(config.variables.homepageJsonUrl, 'items'), function (i, item) {
                if (item.id == id) {

                    //console.log(item);
                }

            });
            //console.log(std.getData(config.variables.homepageJsonUrl, 'items'));

            //var data = std.getData(config.variables.homepageJsonUrl, 'items');
            //this.renderEach('modules/form/item.template', {title: 'quirkey'}, {title: 'endor'}).appendTo('html');

            var data = std.getData(config.variables.homepageJsonUrl, 'items');
            this.renderEach('modules/form/item.template', data).appendTo('html');

            //this.render('modules/form/item.template', {title: 'quirkey'}).appendTo('html');;
            //this.partial('modules/form/items.html', {title: 'Sammy'});
            //this.partial('modules/form/title.template', {title: 'This is variable'});
        });

        /*
         this.partial('modules/form/item.template', function() {
         $.each(std.getData(config.variables.homepageJsonUrl, 'items'), function(i, item) {
         if (item.id == id) {
         //this.partial('modules/form/item.template', {data: item});
         //this.loadPartials({mypartial: 'modules/form/item.template'});
         //this.partial('modules/form/items.html');
         //console.log(item);
         }
         });
         });
         
         //this.partial('modules/form/items.html');
         });
         
         */

        this.get('#/form', function () {
            this.partial('modules/form/index.html');
        });

    });

    var app2 = $.sammy('#test', function () {
        this.get('#/form', function () {
            this.partial('modules/form/test.html');
        });
    });

    $(function () {
        app.run('#/');
        app2.run('#/');
    });

})(jQuery);