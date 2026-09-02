// ======================================================
// 🎨 STYLE (SCSS)
// ======================================================
import "../scss/style.scss";

// ======================================================
// 🧱 BOOTSTRAP – tylko to, co potrzebne
// ======================================================
import 'bootstrap/js/dist/dropdown';
import Collapse from 'bootstrap/js/dist/collapse';
import 'bootstrap/js/dist/modal';

// ======================================================
// 🔥 SWIPER
// ======================================================
import Swiper from 'swiper';
import { Navigation, Pagination } from "swiper/modules";
import 'swiper/css';
import 'swiper/css/navigation';
import "swiper/css/pagination";

// ======================================================
// 🚀 INIT
// ======================================================
document.addEventListener('DOMContentLoaded', () => {

    console.log("🎨 Szlachetna Paczka theme JS loaded!");


    // --------------------------------------------------
    // © COPYRIGHT
    // --------------------------------------------------
    const copyDate = document.getElementById('copyrightDate');

    if (copyDate) {
        copyDate.textContent = new Date().getFullYear();
    }

});