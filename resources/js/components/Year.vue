<template>
    <div class="container card card-body">
        <div class="btn btn-warning text-white text-center">
            <router-link to="/">Year</router-link>&nbsp;
            <router-link to="/productcategory">ProductCategory</router-link
            >&nbsp;
            <router-link to="/incomesource">IncomeSource</router-link>&nbsp;
            <router-link to="/expenssource">ExpensSource</router-link>&nbsp;
        </div>
        <div class="btn btn-info text-center"><h1>This IS Year Page</h1></div>
        <div class="col-md-12">
            Year:
            <input class="form-control col-md-6" type="text" v-model="year" />

             
            <p>Current Year</p>
            <input type="radio" id="html" v-model="year2" value="1" />  
            <label for="html">Yes</label><br />
            <input type="radio" id="css" v-model="year2" value="0" />  
            <label for="css">No</label><br />
        </div>
        <div class="col-12 row">
            <div class="col-4">
                <button
                    v-if="id == 0"
                    @click="save"
                    class="btn btn-primary mt-2"
                >
                    Submit
                </button>
                <button v-else @click="updateUser" class="btn btn-primary mt-2">
                    Update</button
                ><br />
            </div>
        </div>

        <h1>Year Table</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Year</th>
                    <th>Current Year</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody v-for="(d, i) in list" :key="i">
                <tr>
                    <td>{{ i + 1 }}</td>
                    <td>{{ d.year }}</td>
                    <td v-if="( d.current_year =='yes')" style="color: green;">Yes </td>
                    <td v-else style="color: red;"> No</td>
                    <td>
                        <button @click="showUser(d.id)" class="btn btn-success">
                            Edit</button
                        >&nbsp;
                        <button
                            v-on:click="deleteUser(d.id)"
                            class="btn btn-danger"
                        >
                            Delete
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<style>
@media (min-width: 1024px) {
    .about {
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
}
</style>

<script>
import axios from "axios";
export default {
    name: "second",
    data() {
        return {
            list: [],
            year: "",
            current_year: "",
            id: 0,
            year2: 0,
        };
    },
    methods: {
        getUser() {
            axios
                .get("http://127.0.0.1:8000/api/rakib/year/")
                .then((result) => {
                    this.list = result.data.data;
                    //console.log(result.data.data);
                });
        },
        save() {
            if (this.year2 == 0) {
                this.current_year = 'no';
            } else {
                this.current_year = 'yes';
            }
            //console.log(this.current_year);
            axios
                .post("http://127.0.0.1:8000/api/rakib/year/", {
                    year: this.year,
                    current_year: this.current_year,
                })
                .then((response) => {
                    this.year = this.current_year;
                    this.getUser();
                    // console.log(response.data.data);
                });

            this.id = "";
            this.year = "";
            this.current_year= "";
            
        },
        deleteUser(id) {
            axios
                .delete("http://127.0.0.1:8000/api/rakib/year/" + id)
                .then(() => {
                    this.getUser();
                });
        },
        updateUser() {
            if (this.year2 == 0) {
                this.current_year = 'no';
            } else {
                this.current_year = 'yes';
            }
            axios
                .put("http://127.0.0.1:8000/api/rakib/year/" + this.id, {
                    year: this.year,
                    current_year: this.current_year,
                })
                .then((response) => {
                    //console.log(response.status, response.data);
                    
                    this.getUser();
                });
            this.id = "";
            this.year = "";
            this.current_year = "";
        },
        showUser(id) {
            this.id = id;
           
            axios
                .get("http://127.0.0.1:8000/api/rakib/year/" + id + "/edit")
                .then((response) => {
                    const d = response.data.data;
                    console.log(d);
                    this.year = d.year;
                    this.current_year = d.current_year;
                    this.getUser();
                });
        },
    },
    mounted() {
        this.getUser();
    },
};
</script>
