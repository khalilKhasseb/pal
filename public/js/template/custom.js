(function ($) {
    "use strict";


    function __(key) {
        // Get current locale from HTML dir attribute or default to 'en'
        const currentLocale = document.documentElement.lang ||
            document.documentElement.getAttribute('lang') ||
            (document.dir === 'rtl' ? 'ar' : 'en');

        // Translation dictionary
        const translations = {
            'ar': {
                'Your request has been sent successfully': 'تم إرسال طلبك بنجاح',
                'Something went wrong. Please contact us at this email info@palgbc.org': 'حدث خطأ ما. يرجى الاتصال بنا على هذا البريد الإلكتروني info@palgbc.org',
                'Contact Expert': 'تواصل مع الخبير',
                'Your email': 'بريدك الإلكتروني',
                'Enter your email address': 'أدخل عنوان بريدك الإلكتروني',
                'Message': 'الرسالة',
                'Write your message to the expert here...': 'اكتب رسالتك إلى الخبير هنا...',
                'Send Message': 'إرسال الرسالة',
                'Cancel': 'إلغاء',
                'Loading...': 'جاري التحميل...'
            },
            'en': {
                // English is the default, so we return the key as is
            }
        };

        // Return translation if it exists, otherwise return the key itself
        return (translations[currentLocale] && translations[currentLocale][key]) || key;
    }


    function updateModalTexts() {
        // Modal Title
        $('#contactExpertModalLabel').html(`<i class="fa fa-envelope"></i> ${__('Contact Expert')}`);

        // Form Labels and Placeholders
        $('.modal-body label[for="recipient-name"]').text(__('Your email'));
        $('.modal-body input[name="client_email"]').attr('placeholder', __('Enter your email address'));
        $('.modal-body label[for="message-text"]').text(__('Message'));
        $('.modal-body textarea[name="message"]').attr('placeholder', __('Write your message to the expert here...'));

        // Buttons
        $('.modal-footer .btn-outline-secondary').text(__('Cancel'));
        $('.modal-footer .btn-primary span').text(__('Send Message'));
        $('.modal-footer .visually-hidden').text(__('Loading...'));
    }
    $(document).ready(function () {
        $(".select-2").select2({
            theme: "bootstrap-5",
        });

        function logErrorRecursively(error) {
            const _errorObject = {
                error: error,
            };
            $.ajax({
                url: "/ajax/logError",
                type: "POST",
                headers: {
                    Accept: "application/json",
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                data: JSON.stringify(_errorObject),
                success: function (response) { },
                error: function (xhr, status, error) {
                    logErrorRecursively(error);
                },
            });
        }
        // function to submit a modal form via api and wait for response

        /**
   * Expert Contact Modal Functionality
   */
        function handleRequestForClientEmail(triggerButton, url = "/ajax/sendExpertEmail") {
            $(triggerButton).on("click", function (e) {
                $("#expertSpiner").removeClass("d-none");
                e.preventDefault();
                const form = $(".requestForClentEmailForm");
                const formDataJson = {};
                form.serializeArray().map(function (field) {
                    formDataJson[field.name] = field.value;
                });

                if (formDataJson.expert_certifcate_request === "1") {
                    url = "/ajax/requestCertificate";
                }

                $.ajax({
                    url: url,
                    type: "POST",
                    headers: {
                        Accept: "application/json",
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": document
                            .querySelector('meta[name="csrf-token"]')
                            .getAttribute("content"),
                    },
                    data: JSON.stringify(formDataJson),
                    success: function (response) {
                        $("#success").html(
                            `<div class="alert my-2 alert-success alert-dismissible fade show" role="alert">
                        <div class="alert-content">
                            <i class="fa fa-check-circle alert-icon"></i>
                            <span>${__('Your request has been sent successfully')}</span>
                            
                        </div>
                    </div>`
                        );

                        setTimeout(function () {
                            $("#success").html("");
                        }, 3000);
                        $("#expertSpiner").addClass("d-none");

                        // Clear form
                        form[0].reset();
                    },
                    error: function (xhr, status, error) {
                        $("#expertSpiner").addClass("d-none");
                        $(".errors_client_email").removeClass("d-none");

                        if (xhr.status === 422) {
                            $(".errors_client_email").html(
                                `<div class="alert my-2 alert-danger alert-dismissible fade show" role="alert">
                            <div class="alert-content">
                                <i class="fa fa-exclamation-circle alert-icon"></i>
                                <span>${xhr.responseJSON.message}</span>
                                
                            </div>
                        </div>`
                            );
                            return;
                        }

                        $(".errors_client_email").html(
                            `<div class="alert my-2 alert-danger alert-dismissible fade show" role="alert">
                        <div class="alert-content">
                            <i class="fa fa-exclamation-circle alert-icon"></i>
                            <span>${__('Something went wrong. Please contact us at this email info@palgbc.org')}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    </div>`
                        );

                        if (typeof logErrorRecursively === 'function') {
                            logErrorRecursively(xhr.responseJSON);
                        }
                    },
                });
            });
        }

        handleRequestForClientEmail(".sendRequestForClientEmailBtn");

        $("#requestClientEmail").on("show.bs.modal", function (e) {
            const targetButton = e.relatedTarget; // Button that triggered the modal

            // Update texts when modal opens
            updateModalTexts();

            // Check if certificate request attribute exists
            if (
                targetButton &&
                targetButton.getAttribute("data-bs-request-for-client-certifcate") === "1"
            ) {
                $("#expert_certifcate_request").attr(
                    "value",
                    targetButton.getAttribute("data-bs-request-for-client-certifcate")
                );
            } else {
                $("#expert_certifcate_request").attr("value", "0");
            }

            // Clear previous form values and errors
            $(".requestForClentEmailForm")[0].reset();
            $("#success").html("");
            $(".errors_client_email").addClass("d-none").html("");
        });
        // handleRequestForClientEmail("#requestForCertificate");
        //jQuery for page scrolling feature - requires jQuery Easing plugin
        $("a.page-scroll").on("click", function (event) {
            var $anchor = $(this);
            $("html, body")
                .stop()
                .animate(
                    {
                        scrollTop: $($anchor.attr("href")).offset().top,
                    },
                    1500,
                    "easeInOutExpo"
                );
            event.preventDefault();
        });

        // ul child item
        $(".main-menu-area ul>li>ul")
            .parent("li")
            .addClass("menu-item-has-children");
        $(".main-menu-area ul li a").on("click", function (e) {
            var element = $(this).parent("li");
            if (element.hasClass("open")) {
                element.removeClass("open");
                element.find("li").removeClass("open");
                element.find("ul").slideUp(300, "swing");
            } else {
                element.addClass("open");
                element.children("ul").slideDown(300, "swing");
                element.siblings("li").children("ul").slideUp(300, "swing");
                element.siblings("li").removeClass("open");
                element.siblings("li").find("li").removeClass("open");
                element.siblings("li").find("ul").slideUp(300, "swing");
            }
        });

        //LightCase

        $("a[data-rel^=lightcase]").lightcase();

        // $('.lightbox-item').lightcase();


        //Js code for search box

        $(".first_click").on("click", function () {
            $(".menu-right-option").addClass("search_box");
        });
        $(".second_click").on("click", function () {
            $(".menu-right-option").removeClass("search_box");
        });

        //countdown
        // $('.counter').counterUp({
        //     delay: 10,
        //     time: 1000
        // });
        $(window).on("scroll", function () {
            $(".counter").data("countToOptions", {
                formatter: function (value, options) {
                    return value
                        .toFixed(options.decimals)
                        .replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
                },
            });
            // start all the timers
            $(".counter").each(count);
            function count(options) {
                var $this = $(this);
                options = $.extend(
                    {},
                    options || {},
                    $this.data("countToOptions") || {}
                );
                $this.countTo(options);
            }
        });

        //Sponsors swiper

        var swiper = new Swiper(".sponsors-container", {
            pagination: ".swiper-pagination",
            slidesPerView: 4,
            spaceBetween: 20,
            // autoplay: 3000,
            paginationClickable: true,
            nextButton: ".swiper-button-next",
            prevButton: ".swiper-button-prev",
            breakpoints: {
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                400: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            },
        });

        //testimonial swiper

        var swiper = new Swiper(".testimonial-container", {
            pagination: ".swiper-pagination",
            slidesPerView: 3,
            spaceBetween: 20,
            autoplay: 3000,
            paginationClickable: true,
            nextButton: ".swiper-button-next",
            prevButton: ".swiper-button-prev",
            breakpoints: {
                1024: {
                    slidesPerView: 3,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 2,
                    spaceBetween: 30,
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                400: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            },
        });

        //people say container swiper

        var swiper = new Swiper(".people-say-container", {
            pagination: ".swiper-pagination",
            slidesPerView: 1,
            spaceBetween: 25,
            autoplay: false,
            paginationClickable: true,
            nextButton: ".swiper-button-next",
            prevButton: ".swiper-button-prev",
            breakpoints: {
                1024: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                768: {
                    slidesPerView: 1,
                    spaceBetween: 30,
                },
                640: {
                    slidesPerView: 1,
                    spaceBetween: 20,
                },
                400: {
                    slidesPerView: 1,
                    spaceBetween: 10,
                },
            },
        });

        //Pre-Loader

        $("#loading").delay(2000).fadeOut(500);
        $("#loading-center").on("click", function () {
            $("#loading").fadeOut(500);
        });

        //Scroll Top Top

        var link,
            toggleScrollToTopLink = function () {
                if ($("body").scrollTop() > 0 || $("html").scrollTop() > 0) {
                    link.fadeIn(400);
                } else {
                    link.fadeOut(400);
                }
            };

        link = $(".scroll-img");

        $(window).scroll(toggleScrollToTopLink);

        toggleScrollToTopLink();

        link.on("click", function () {
            $("body").animate({ scrollTop: 0 });
            $("html").animate({ scrollTop: 0 });
        });

        //Menu Fixed Top

        var fixed_top = $(".menu-scroll");

        $(window).on("scroll", function () {
            if ($(this).scrollTop() > 100) {
                fixed_top.addClass("menu-fixed animated fadeInDown");
            } else {
                fixed_top.removeClass("menu-fixed animated fadeInDown");
            }
        });

        //Pricing Slider

        $(".nstSlider").nstSlider({
            left_grip_selector: ".leftGrip",
            right_grip_selector: ".rightGrip",
            value_bar_selector: ".bar",
            value_changed_callback: function (cause, leftValue, rightValue) {
                $(this).parent().find(".leftLabel").text(leftValue);
                $(this).parent().find(".rightLabel").text(rightValue);
            },
        });

        //Flex Slider

        $(window).load(function () {
            // The slider being synced must be initialized first
            $("#carousel").flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                itemWidth: 74,
                itemMargin: 5,
                asNavFor: "#slider",
            });

            $("#slider").flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel",
            });
        });

        //nst Slider

        $(".nstSlider").nstSlider({
            left_grip_selector: ".leftGrip",
            right_grip_selector: ".rightGrip",
            value_bar_selector: ".bar",
            value_changed_callback: function (cause, leftValue, rightValue) {
                $(this).parent().find(".leftLabel").text(leftValue);
                $(this).parent().find(".rightLabel").text(rightValue);
            },
        });

        //Sidebar Menu
        $(".color-btn").on("click", function () {
            $(".box-style").toggleClass("open");
        });

        $(".boxed-btn").on("click", function () {
            $("body").addClass("boxed");
        });

        $(".wide-btn").on("click", function () {
            $("body").removeClass("boxed");
        });

        $(".rtl-btn").on("click", function () {
            $("body").addClass("rtl");
            var body = document.querySelector("body");
            body.setAttribute("dir", "rtl");
        });

        $(".ltl-btn").on("click", function () {
            $("body").removeClass("rtl");
            var body = document.querySelector("body");
            body.setAttribute("dir", "ltl");
        });

        //ToolTips

        (function initlizeToolTips() {
            const tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]')
            );
            const tooltipList = tooltipTriggerList.map(function (
                tooltipTriggerEl
            ) {
                return new bootstrap.Tooltip(tooltipTriggerEl, {
                    container: "body",
                });
            });
        })();
    });
})(jQuery);
