<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Orders Management</h3>

                        <div class="card-tools">
                            <button
                                class="btn btn-sm btn-primary"
                                @click="newModal"
                            >
                                Add Orders
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#id</th>
                                <th>Title</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Description</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="order in orders.data" :key="order.id">
                                <td>{{order.id}}</td>
                                 <td>{{order.title}}</td>
                                 <td>{{order.price}}</td>
                                 <td>{{order.quantity}}</td>
                                 <td>{{order.Description}}</td>
                                 <td>
                                    <i class="btn btn-info">Edit</i>
                                 </td>
                                 <td>
                                    <i class="btn btn-danger" >Delete</i>
                                 </td>

                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="addnewLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!this.editMode">Create Order</h5>
                        <h5 class="modal-title" v-if="this.editMode">Edit Oder</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Title</label>
                                <input v-model="form.title"  type="text" name="title"
                                       placeholder="Enter Title"
                                       class="form-control">
                               
                            </div>
                            <div class="form-group">
                                <label>Price</label>
                                <input v-model="form.price" type="text" name="price"
                                       placeholder="Enter price"
                                       class="form-control">
                               
                            </div>
                            <div class="form-group">
                                <label>Quantity</label>
                                <input v-model="form.quantity" type="text" name="quantity"
                                       placeholder="Enter Quantity"
                                       class="form-control">
                               
                            </div>
                            <div class="row">
                                <div class="form-group" style="padding: 20px">
                                    <label for="description">Description</label>
                                    <input  v-model="form.description" type="text" name="description"
                                            placeholder="Enter Description"
                                            class="form-control">
                                       
                                   
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" v-if="!this.editMode"  @click="addOrder">
                                Create
                            </button>
                            <button type="button" class="btn btn-success"  v-if="this.editMode">
                                Update
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform';
export default  {
    name: "Orders Management",
    data() {
        
        return {
           orders:'',
            editMode: "",
            form: new Form({
                id: "",
                title: "",
                price: "",
                quantity: "",
                description: "",
            }),
        };
    },
    methods: {
       updateOrders() {
            this.form
                .put("api/orders/" + this.form.id)
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch(() => {});
        },
        editOrder(order) {
            this.editMode = true;
            $("#addnew").modal("show");
            this.form.fill(order);
        },
        getOrders() {
            axios
                .get("/api/orders")
                .then(({ data }) => [(this.orders = data)]);
        },
        addOrder() {
            this.form
                .post("api/orders")
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch((error) => {
                    this.errors = error.response.data.errors;
                });
        },
        newModal() {
            this.editMode = false;
            $("#addnew").modal("show");
        },
    },
    created() {
        this.getOrders();
    },
};
</script>

<style scoped>

</style>
