import ResponsiveAutoHeight from "responsive-auto-height";
import { registerWidget } from "../lib/utils";

class Zeus_BlogGrid extends elementorModules.frontend.handlers.Base {
    getDefaultSettings() {
        return {
            selectors: {
                blogGrid: ".zeus-blog-grid",
            },
        };
    }

    getDefaultElements() {
        const element = this.$element.get(0);
        const selectors = this.getSettings("selectors");

        return {
            blogGrid: element.querySelector(selectors.blogGrid),
        };
    }

    onInit(...args) {
        super.onInit(...args);

        if (this.isEqualHeight()) {
            this.initEqualHeight();
        }
    }

    initEqualHeight() {
        const blogGridItemsSelector = `${this.getSettings("selectors.blogGrid")} .zeus-grid-inner`;

        new ResponsiveAutoHeight(blogGridItemsSelector);
    }

    isEqualHeight() {
        return this.elements.blogGrid.classList.contains("match-height-grid");
    }
}

registerWidget(Zeus_BlogGrid, "zeus-blog-grid");
