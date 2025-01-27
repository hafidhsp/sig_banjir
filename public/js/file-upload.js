// (function($) {
//     'use strict';
//     $(function() {
//       $('.file-upload-browse').on('click', function() {
//         var file = $(this).parent().parent().parent().find('.file-upload-default');
//         file.trigger('click');
//       });
//       $('.file-upload-default').on('change', function() {
//         $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
//       });
//     });
//   })(jQuery);
(function($) {
        'use strict';
        $(function() {
            // Trigger file selection
            $('.file-upload-browse').on('click', function() {
                var file = $(this).parent().parent().parent().find('.file-upload-default');
                file.trigger('click');
            });

            // Update text input with selected file names
            $('.file-upload-default').on('change', function() {
                var files = Array.from(this.files).map(file => file.name).join(', ');
                $(this).parent().find('.form-control').val(files);
            });
        });
    })(jQuery);
