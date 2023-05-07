(function ($) {
    "use strict";
    $(document).on('change', '#hero_image', function (event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.showHeroImage img').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    })
    $(document).on('change', '#about_image', function (event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.showAboutImage img').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    })
    $(document).on('change', '#skills_image', function (event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.showSkillsImage img').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    })
    $(document).on('change', '#achievement_image', function (event) {
        var file = event.target.files[0];
        var reader = new FileReader();
        reader.onload = function (e) {
            $('.showAchievementImage img').attr('src', e.target.result);
        };

        reader.readAsDataURL(file);
    })

    let fd = new FormData();
    $(".image-cross-btn").on('click', function() {
        $.post(imageRemoveRoute, {
            langId: langId,
            userId: userId,
            type: $(this).data('type')
        },
        function(data) {
            if (data == "success") {
                location.reload();
            }
        })
    });
})(jQuery); 
