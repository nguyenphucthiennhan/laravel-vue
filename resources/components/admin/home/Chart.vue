<template>
  <div class="revenue-chart">
    <canvas ref="myChart"></canvas>
    <div class="btn-group button">
      <button class="btn btn-primary" @click="changeData('month')">Tháng</button>
      <button class="btn btn-success" @click="changeData('year')">Năm</button>
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
    };
  },
  methods: {
    async changeData(timeframe) {
      let url = timeframe === 'year' ? '/api/revenueM' : '/api/revenue';
      let response = await axios.get(url);
      let revenueData = response.data;
      if (revenueData) {
        let labels = revenueData.map(item => item.date);
        let data = revenueData.map(item => item.revenue);

        if (this.myChart) {
          this.myChart.destroy();
        }

        let ctx = this.$refs.myChart.getContext('2d');
        this.myChart = new Chart(ctx, {
          type: 'line',
          data: {
            labels: labels,
            datasets: [
              {
                label: 'Doanh thu tính băng (USD)',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
              }
            ]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      } else {
        console.error('Unexpected response data structure', revenueData);
      }
    }


  },
  mounted() {
    this.changeData('month');
  },
};
</script>

<style scoped>
.revenue-chart {
  width: 600px;
  position: absolute;
  display: inline-block;
  top: 100px;
  left: 150px;
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
  right: 50px;
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