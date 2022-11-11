<template>
    <form @submit.prevent="store" id="form">
        <section v-if="errors != null">
            <div class="alert alert-danger">
                <span>
                    <strong v-if="errors != null">Error {{ errors.code }} : </strong>
                </span>
                <span>
                    {{ errors.message }}
                </span>
                <ul v-if="errors.code == 400">
                    <li v-for="(errorList , iteration) in errors.errors">
                        <span v-for="(lists , iteration) in errorList">
                            {{ lists }}
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <section class="form-row">
            <div class="form-group">
                <label for="name">Name:</label>
                <input v-model="student.name" placeholder="Name :" type="text" name="name" id="name" class="form-control mb-4 col">
            </div>
            <div class="form-group">
                <label for="email">E-mail :</label>
                <input v-model="student.email" placeholder="E-mail :" type="email" name="email" id="email" class="form-control mb-4 col">
            </div>
            <div class="form-group">
                <label for="file">File:</label>
                <input v-on:change="onFileChange(e)" placeholder="File :" type="file" name="file" id="file" class="form-control mb-4 col">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="radio" style="margin-left: 30px;"  name="gender" id="gender" value="male" v-model="student.gender" />
                <label>Male </label>

                <input type="radio" style="margin-left: 30px;"  id="gender" name="gender" value="female" v-model="student.gender" />
                <label>Female</label>
            </div>
            <div class="form-group">
                <label for="skill">Skill:</label>
                
                <input type="checkbox" style="margin-left:30px;" name="laravel" id="laravel" value="1" v-model="student.laravel">
                <label for="laravel"> Laravel</label>

                <input type="checkbox" style="margin-left: 30px;" name="codeigniter" id="codeigniter" value="1" v-model="student.codeigniter">
                <label for="laravel"> Codeigniter</label>

                <input type="checkbox" style="margin-left: 30px;" name="vuejs" id="vuejs" value="1" v-model="student.vuejs">
                <label for="vuejs"> VUE JS</label>

                <input type="checkbox" style="margin-left: 30px;" name="ajax" id="ajax" value="1" v-model="student.ajax">
                <label for="ajax"> Ajax</label>

                <input type="checkbox" style="margin-left: 30px;" name="mysql" id="mysql" value="1" v-model="student.mysql">
                <label for="mysql"> MySQL</label>

                <input type="checkbox" style="margin-left: 30px;" name="api" id="api" value="1" v-model="student.api">
                <label for="api"> Api</label>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-sm">Submit</button>
            </div>
        </section>
    </form>
</template>

<script>

export default {
    data(){
        return{
            student:{},
            errors:null,
        }
    },

    methods:{
        onFileChange(e){
            this.student.file = e.target.files[0];
        },
        store:function(){

            let form = document.getElementById("form");
						let formData = new FormData(form);
                        formData.append('file',this.student.file);

            axios.post('/api/student',formData)
            .then((response)=>{
                console.log(response);
                this.$router.push({ name: 'student-table' });
            })
            .catch((error)=>{
                let collection = error.response.data;
                this.errors = collection;
            });
        }
    }
}
</script>
