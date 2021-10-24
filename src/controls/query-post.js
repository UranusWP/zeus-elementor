/**
 * Because Elementor plugin uses jQuery for controls,
 * We also have to use jQuery to create new one
 */
jQuery(document).ready(() => {
    jQuery(window).on("elementor:init", function () {
        const ControlQueryPostSearch = elementor.modules.controls.BaseData.extend({
            isPostSearchReady: false,

            getPostTitlesbyID: function () {
                const self = this;
                let postIDs = this.getControlValue();

                if (!postIDs) {
                    return;
                }

                if (!_.isArray(postIDs)) {
                    postIDs = [postIDs];
                }

                self.addControlSpinner();

                /**
                 * Because Elementor plugin uses jQuery for controls,
                 * We also have to use jQuery to create new one
                 */
                jQuery.ajax({
                    url: ajaxurl,
                    type: "POST",
                    data: {
                        action: "zeus_get_posts_title_by_id",
                        nonce: queryPostData.nonce,
                        id: postIDs,
                    },
                    success: function (results) {
                        console.log(results);
                        self.isPostSearchReady = true;
                        self.model.set("options", results);
                        self.render();
                    },
                });
            },
            addControlSpinner: function () {
                this.ui.select.prop("disabled", true);
                this.$el
                    .find(".elementor-control-title")
                    .after(
                        '<span class="elementor-control-spinner">&nbsp;<i class="eicon-spinner eicon-animation-spin"></i>&nbsp;</span>'
                    );
            },
            onReady: function () {
                var self = this;

                this.ui.select.select2({
                    placeholder: "Search",
                    allowClear: true,
                    minimumInputLength: 2,

                    ajax: {
                        url: ajaxurl,
                        dataType: "json",
                        method: "post",
                        delay: 250,
                        data: function (params) {
                            return {
                                action: "zeus_get_posts_by_query",
                                nonce: queryPostData.nonce,
                                q: params.term, // search term
                                post_type: self.model.get("post_type"),
                            };
                        },
                        processResults: function (data) {
                            return {
                                results: data,
                            };
                        },
                        cache: true,
                    },
                });

                if (!this.isPostSearchReady) {
                    this.getPostTitlesbyID();
                }
            },
            onBeforeDestroy: function () {
                if (this.ui.select.data("select2")) {
                    this.ui.select.select2("destroy");
                }

                this.$el.remove();
            },
        });

        elementor.addControlView("zeus-query-posts", ControlQueryPostSearch);
    });
});