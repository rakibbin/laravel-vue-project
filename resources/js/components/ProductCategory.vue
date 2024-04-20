<template>
    <div class="container card">
        <div class="btn btn-warning text-white text-center">
            <router-link to="/">Year</router-link>&nbsp;
            <router-link to="/productcategory">ProductCategory</router-link
            >&nbsp;
            <router-link to="/incomesource">IncomeSource</router-link>&nbsp;
            <router-link to="/expenssource">ExpensSource</router-link>&nbsp;
        </div>
        <div class="btn btn-info text-center">
            <h1>This IS Product Category Page</h1>
        </div>
        <div class="col-md-12">
            Name:
            <input class="form-control col-md-6" type="text" v-model="name" />

            Status:
            <select class="form-control col-md-6" v-model="status">
                <option value="active" style="background-color: aqua;">Active</option>
                <option value="inactive" >Inactive</option>
            </select>
            
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

        <h1>Product Category Table</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Sl</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody v-for="(d, i) in list" :key="i">
                <tr>
                    <td>{{ i + 1 }}</td>
                    <td>{{ d.name }}</td>
                    <td v-if="( d.status =='active')" style="color: green;">Active </td>
                    <td v-else style="color: red;"> Inactive</td>
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
            name: "",
            status: "",
            id: 0,
        };
    },
    methods: {
        getUser() {
            axios
                .get("http://127.0.0.1:8000/api/rakib/pcategory/")
                .then((result) => {
                    this.list = result.data.data;
                    console.log(result.data.data);
                });
        },
        save() {
            axios
                .post("http://127.0.0.1:8000/api/rakib/pcategory/", {
                    name: this.name,
                    status: this.status,
                    password: this.password,
                })
                .then((response) => {
                    this.name = this.status;
                    this.getUser();
                });
            this.id = "";
            this.name = "";
            this.status = "";
        },
        deleteUser(id) {
            axios
                .delete("http://127.0.0.1:8000/api/rakib/pcategory/" + id)
                .then(() => {
                    this.getUser();
                });
        },
        updateUser() {
            axios
                .put("http://127.0.0.1:8000/api/rakib/pcategory/" + this.id, {
                    name: this.name,
                    status: this.status,
                })
                .then((response) => {
                    console.log(response.status, response.data);
                    this.getUser();
                });
            this.id = "";
            this.name = "";
            this.status = "";
        },
        showUser(id) {
            this.id = id;
            axios
                .get(
                    "http://127.0.0.1:8000/api/rakib/pcategory/" + id + "/edit"
                )
                .then((response) => {
                    const d = response.data.data;
                    this.name = d.name;
                    this.status = d.status;
                    this.getUser();
                });
        },
    },
    mounted() {
        this.getUser();
    },
};
</script>
