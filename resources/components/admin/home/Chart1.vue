<template>
    <div>
        <div class="most-chart">
            <canvas ref="myChart1"></canvas>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import Chart from 'chart.js/auto';

export default {
    data() {
        return {
            myChart: null,
            total: null,
            colors: ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'],
        };
    },
    methods: {
        async getProducts() {
            const url = '/api/most-products';
            const response = await axios.get(url);
            return response.data;
        },
        async createChart() {
            let productData = await this.getProducts();
            if (productData) {
                let labels = productData.map(item => item.name);
                let data = productData.map(item => item.total_quantity);

                if (this.myChart) {
                    this.myChart.destroy();
                }

                this.$nextTick(() => {
                    let ctx = this.$refs.myChart1.getContext('2d');
                    this.myChart = new Chart(ctx, {
                        type: 'bar',
                        data: {
                            labels: labels,
                            datasets: [{
                                label: 'Sản phẩm bán ra nhiều nhất (Download)',
                                data: data,
                                backgroundColor: this.colors,
                                borderColor: this.colors,
                                borderWidth: 1
                            }]
                        },
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                    });
                });
            } else {
                console.error('Unexpected response data structure', productData);
            }
        }

    },
    mounted() {
        this.createChart();
    },
};
</script>

<style scoped>
.revenue-chart {
    width: 600px;
    position: absolute;
    display: inline-block;
    top: 100px;
    left: 100px;
    background: #fff;
    border-radius: 25px;
    border: 15px solid #fff;
    border-bottom: 50px solid #fff;
    box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75);
}

.button {
    position: absolute;
    bottom: -30px;
    right: 10px;
}

.most-chart {
    position: absolute;
    top: 100px;
    right: 150px;
    width: 600px;
    background: #fff;
    border-radius: 25px;
    border: 15px solid #fff;
    border-bottom: 50px solid #fff;
    box-shadow: 10px 10px 5px 0px rgba(0, 0, 0, 0.75);
}

.card {
    position: absolute;
    background: rgb(255, 68, 0);
    padding: 20px 10px;
    color: #fff;
    top: 550px;
    left: 20px;
    width: 250px;
    box-shadow: 10px 10px 5px 0px rgba(85, 82, 82, 0.75);
}
</style>