<template>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"></h1>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-success text-white mb-4">
                        <div class="card-body">
                            <h3>TODAY SALES</h3><br>

                            <h4>Total sales :{{dailySalecount}}</h4>
                            <div class='huge h5'> Total Amount : Ksh {{totalAmountsDaily}}</div>

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <router-link to="/dailyreport" class="small text-white stretched-link">
                                <div class='huge'> </div>VIEW
                            </router-link>

                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6">
                    <div class="card bg-primary text-white mb-4">

                        <div class="card-body">
                            <h3>General Sales</h3>
                            <div style="font-size:120%;"> <span>This Week sales:{{WeeklySalecount }}</span> -&nbsp;
                                <span>Ksh {{totalAmountWeekly}}</span>
                            </div>

                            <div style="font-size:120%;"><span>This Month sales:{{MonthlySalecount }}</span>-&nbsp;
                                <span>Ksh {{totalAmountMonthly}}</span>
                            </div> <hr>

                            <h5>Grand Total sales :{{salecount}}</h5>
                            <div class='huge h5'>
                                
                                <span>Total Amount : Ksh {{totalAmounts}}</span> 
                            </div>

                        </div>

                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <router-link to="/sales" class="small text-white stretched-link">
                                <div class='huge'> </div>VIEW
                            </router-link>


                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-warning text-white mb-4">
                        <div class="card-body">
                            <h3>STOCK</h3>

                            <h4>Total :{{productcount}} items</h4>
                            <div class='huge h5'> COST : Ksh {{totalProducts}}</div>

                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <a class="small text-white stretched-link" href="#">
                                <div class='huge'> </div>VIEW
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6">
                    <div class="card bg-info text-white mb-4">
                        <div class="card-body">CATEGORIES

                            <div class='huge'>coming</div>
                        </div>
                        <div class="card-footer d-flex align-items-center justify-content-between">

                            <a class="small text-white stretched-link" href="#">
                                <div class='huge'> </div>viewed results
                            </a>
                            <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
</template>

<script>
export default {

    data() {

        return {

            showAlert: false,
            //  form: null,
            // edit: false,
            editMode: false,
            myProducts: [],
            mycategories: [],
            DailySales: [],
            sales: [],
            MonthlySales: [],
            WeeklySales: [],

        }

    },

    computed: {
        totalAmountsDaily() {
            return this.DailySales.reduce((total, daysales) => total + parseFloat(daysales.total_price), 0);
        },

        totalAmountWeekly() {
            return this.WeeklySales.reduce((total, weeksales) => total + parseFloat(weeksales.total_price), 0);
        },

        totalAmountMonthly() {
            return this.MonthlySales.reduce((total, monthsales) => total + parseFloat(monthsales.total_price), 0);
        },

        totalAmounts() {

            return this.sales.reduce((total, daysales) => total + parseFloat(daysales.total_price), 0);
        },
        totalProducts() {

            return this.myProducts.reduce((total, products) => total + parseFloat(products.total_price), 0);
        },

        dailySalecount() {
            return this.DailySales.length;
        },
        WeeklySalecount() {
            return this.WeeklySales.length;
        },

        salecount() {

            return this.sales.length;
        },

        productcount() {

            return this.myProducts.length;
        },
        MonthlySalecount() {

            return this.MonthlySales.length;
        }

    },

    mounted() {
        this.getDailySales();
        this.getMonthlySales();
        this.getProducts();
        this.getWeeklySales()
        //this.getCategories();
        this.getSales();
       
      


    },

    methods: {

        getDailySales() {
           this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getDailySales").then(response => {
                this.DailySales = response.data.data;
                //  this.totalAmountsDaily();
            this.$emitter.emit('changeLoaderStatus', false)

            })

        },
        getMonthlySales() {
          this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getMonthlySales").then(response => {
                this.MonthlySales = response.data.data;
                //  this.totalAmountsDaily();
             this.$emitter.emit('changeLoaderStatus', false)

            })

        },
        getWeeklySales() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getWeeklySales").then(response => {
                this.WeeklySales = response.data.data;
                //  this.totalAmountsDaily();
                 this.$emitter.emit('changeLoaderStatus', false)

            })

        },

        getProducts() {
            this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getProducts").then(response => {
                this.myProducts = response.data.data;

                this.$emitter.emit('changeLoaderStatus', false)
            })

        },

        getSales() {
             this.$emitter.emit('changeLoaderStatus', true)
            axios.get("http://127.0.0.1:8000/api/getSales").then(response => {
                this.sales = response.data.data;

                 this.$emitter.emit('changeLoaderStatus', false)
              this.totalAmounts();
            })

        },

    },

}
</script>
