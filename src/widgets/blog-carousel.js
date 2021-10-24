import { registerWidget } from "../lib/utils";
import Zeus_Carousel from "./base/carousel";

class Zeus_BlogCarousel extends Zeus_Carousel {}

registerWidget(Zeus_BlogCarousel, "zeus-blog-carousel");
