import Alpine from 'alpinejs';
import Chart from 'chart.js/auto';
import smartPricing from './components/smartPricing';

window.Alpine = Alpine;
window.Chart = Chart;

Alpine.data('smartPricing', smartPricing);

Alpine.start();
