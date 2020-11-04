 <script>
  import { Bar } from 'vue-chartjs'
  export default {
    props: ['labels','datasets'],
    extends: Bar,
    data: () => ({
      chartdata: {
        labels: ['January', 'February'],
        datasets: [
          {
            label: 'Data One',
            backgroundColor: '#f87979',
            data: [40, 20]
          }
        ]
      },
      options: {
        responsive: true,
        maintainAspectRatio: false
      }
    }),
    methods: {
      init(){
        this.chartdata.labels = this.labels??this.chartdata.labels
        this.chartdata.datasets = this.datasets??this.chartdata.datasets
        this.renderChart(this.chartdata, this.options)
      }
    },
    mounted () {
      this.init()
    }
  }
</script>
