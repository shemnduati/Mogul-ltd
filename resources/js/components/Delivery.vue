<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card mt-4">
                    <div class="card-header">
                        <h3 class="card-title">Delivery</h3>

                        <div class="card-tools">
                            <button class="btn btn-sm btn-primary" @click="newModal">
                                Add Delivery
                            </button>
                        </div>
                    </div>
                    <div class="card-body table-responsive p-0">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th>#id</th>
                                <th>Order Title</th>
                                <th>Delivery Status</th>
                                <th>Vehicle Registration</th>
                                <th>Location</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="dev in delivery" :key="dev.id">
                                <td>{{dev.id}}</td>
                                 <td>{{dev.title}}</td>
                                 <td>{{dev.status}}</td>
                                 <td>{{dev.registration}}</td>
                                 <td>{{dev.location}}</td>
                                 <td>
                                    <i class="btn-sm btn-info">Edit</i>
                                 </td>
                                 <td>
                                    <i class="btn-sm btn-danger" >Delete</i>
                                 </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="addnew" tabindex="-1" role="dialog" aria-labelledby="addnewLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" v-if="!this.editMode">Add Station Location</h5>
                        <h5 class="modal-title" v-if="this.editMode">Edit Location</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form>
                        <div class="modal-body">
                        <div class="form-group">
                                        <label for="level">Select An Order</label>
                                        <select v-model="form.orderId" class="form-control" name="orderId" id="orderId">
                                            <option selected value="">--Select Order--</option>
                                            <option  v-for="order in orders.data" :key="order.id" :value="order.id">{{ order.title}}</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                        <label for="level">Delivery Status</label>
                                        <select v-model="form.deliveryStatus" class="form-control" name="deliveryStatus" id="deliveryStatus">
                                            <option selected value="">--Select Stauts--</option>
                                            <option  v-for="statu in status.data" :key="statu.id" :value="statu.id">{{ statu.status}}</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                        <label for="level">Select Delivery Vehicle</label>
                                        <select v-model="form.vehicleId" class="form-control" name="vehicleId" id="vehicleId:">
                                            <option selected value="">--Select Delivery Vehicle--</option>
                                             <option  v-for="vehicle in vehicles" :key="vehicle.id" :value="vehicle.id">{{ vehicle.registration}}</option>
                                        </select>
                            </div>
                            <div class="form-group">
                                        <label for="level">Select Destination</label>
                                        <select v-model="form.locationId" class="form-control" name="locationId" id="locationId">
                                            <option selected value="">--Select Destination--</option>
                                             <option  v-for="location in locations.data" :key="location.id" :value="location.id">{{ location.location}}</option>
                                        </select>
                            </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" v-if="!this.editMode" @click="addDelivery">
                                Create
                            </button>
                            <button type="button" class="btn btn-success"  v-if="this.editMode">
                                Update
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
</template>

<script>
import { Form, HasError, AlertError } from 'vform';
export default {
    name: "Delivery",
    data() {
        return {
            vehicles:'',
            orders:'',
            locations:'',
            status:'',
            delivery:'',
            editMode: "",
            form: new Form({
                id: "",
                orderId: "",
                deliveryStatus: "",
                vehicleId: "",
                locationId: "",
            }),
        };
    },
    methods: {
   updateDelivery() {
            this.form
                .put("api/delivery/" + this.form.id)
                .then(() => {
                    $("#addnew").modal("hide");
                })
                .catch(() => {});
        },
        editVehicle(del) {
            this.editMode = true;
            $("#addnew").modal("show");
            this.form.fill(del);
        },
        getVehicle() {
            axios
                .get("/api/vehicle")
                .then(({ data }) => [(this.vehicles = data['parent'])]);
        },
        getDelivery() {
            axios
                .get("/api/delivery")
                .then(({ data }) => [(this.delivery = data['parent'])]);
        },
        getLocation() {
            axios
                .get("/api/location")
                .then(({ data }) => [(this.locations = data)]);
        },
         getOrders() {
            axios
                .get("/api/orders")
                .then(({ data }) => [(this.orders = data)]);
        },
        getStatus() {
            axios
                .get("/api/deliveryStatus")
                .then(({ data }) => [(this.status = data)]);
        },
        addDelivery() {
            this.form
                .post("api/delivery")
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
        this.getLocation();
        this.getVehicle();
        this.getStatus();
        this.getDelivery();
    },
};
</script>

<style scoped></style>
