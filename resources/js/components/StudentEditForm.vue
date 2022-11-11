<template>
    <form @submit.prevent="update">
        <section v-if="errors != null">
            <div class="alert alert-danger">
                <span>
                    <strong v-if="errors != null">Error {{ errors.code }} : </strong>
                </span>
                <span>
                    {{ errors.message }}
                </span>
                <ul v-if="errors.code == 400">
                    <li v-for="(errorList, iteration) in errors.errors">
                        <span v-for="(lists, iteration) in errorList">
                            {{ lists }}
                        </span>
                    </li>
                </ul>
            </div>
        </section>
        <section class="form-row">
            <div class="form-group">
                <label for="name">Name:</label>
                <input v-model="students.name" placeholder="Name :" type="text" name="name" id="name" class="form-control mb-4 col">
            </div>
            <div class="form-group">
                <label for="email">E-mail :</label>
                <input v-model="students.email" placeholder="E-mail :" type="email" name="email" id="email" class="form-control mb-4 col">
            </div>
            <div class="form-group">
                <label for="file">File:</label>
                <input v-on:change="onFileChange(e)" placeholder="File :" type="file" name="file" id="file" class="form-control mb-4 col">
            </div>
            <div class="form-group">
                <label for="gender">Gender:</label>
                <input type="radio" style="margin-left: 30px;"  name="gender" id="gender" value="male" v-model="students.gender" />
                <label>Male </label>

                <input type="radio" style="margin-left: 30px;"  id="gender" name="gender" value="female" v-model="students.gender" />
                <label>Female</label>
            </div>

            <div class="form-group">
                <label for="">Skill:</label>
                
                <input type="checkbox" style="margin-left:30px;" name="laravel" id="laravel" value="1" v-model="students.laravel" :checked="isChecked(students.laravel)">
                <label for="laravel"> Laravel</label>

                <input type="checkbox" style="margin-left: 30px;" name="codeigniter" id="codeigniter" value="1" v-model="students.codeigniter" :checked="isChecked(students.codeigniter)">
                <label for="laravel"> Codeigniter</label>

                <input type="checkbox" style="margin-left: 30px;" name="vuejs" id="vuejs" value="1" v-model="students.vuejs" :checked="isChecked(students.vuejs)">
                <label for="vuejs"> VUE JS</label>

                <input type="checkbox" style="margin-left: 30px;" name="ajax" id="ajax" value="1" v-model="students.ajax" :checked="isChecked(students.ajax)">
                <label for="ajax"> Ajax</label>

                <input type="checkbox" style="margin-left: 30px;" name="mysql" id="mysql" value="1" v-model="students.mysql" :checked="isChecked(students.mysql)">
                <label for="mysql"> MySQL</label>

                <input type="checkbox" style="margin-left: 30px;" name="api" id="api" value="1" v-model="students.api" :checked="isChecked(students.api)">
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
        return {
            errors:null,
            students:{},
        }
    },
    created(){
        this.fetch();
    },
    methods:{
        isChecked(obj) {
                return (typeof obj === "boolean" )
                    ? obj
                    : typeof obj === "string" && obj === '1';
            },
       
        fetch:function(){
            axios.get('/api/student/'+ this.$route.params.id)
            .then((response)=>{
                this.students = response.data.data;
            });
        },
       
        update:function(){

            axios.put('/api/student/'+this.$route.params.id,this.students)
            .then((response)=>{
                let result = response.data;
                if(response.data.code == 200){
                    this.$router.push({ name: 'student-table' });
                }
            })
            .catch((error)=>{
                let items = error.response.data;
                this.errors = items;
            });
        }
    }
}
</script>