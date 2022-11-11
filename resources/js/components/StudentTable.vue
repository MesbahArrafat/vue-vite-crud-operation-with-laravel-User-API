<template>
    <section>    
        <div class="row">
            <table class="table">
                <thead>
                    <tr>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Image</td>
                        <td>Gender</td>
                        <td>Skills</td>
                        <td colspan="2">Action</td>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="student in students" :key="student.id">
                        <td>{{ student.name }}</td>
                        <td>{{ student.email }}</td>
                        <td><img :src="getImage(student.file)" style="width:100px; height:100px"/></td>
                        <td>{{ student.gender }}</td>
                        <td><span v-if="student.laravel">laravel,</span>
                            <span v-if="student.mysql">mysql,</span>
                            <span v-if="student.codeigniter">codeigniter,</span>
                            <span v-if="student.ajax">ajax,</span>
                            <span v-if="student.vuejs">vuejs,</span>
                            <span v-if="student.api">api</span>
                        </td>
                        <td>
                            <router-link :to="'/student/edit/'+student.id" class="btn btn-sm btn-warning col w-100">Edit
                            </router-link>
                        </td>
                        <td>
                            <button class="btn btn-sm btn-danger col w-100" @click="deleteStudent(student.id)">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </section>
</template>
<script>
export default{
    data(){
        return {
            students:{}
        }
    },
    created(){ 
        this.fetchStudent();
    },
    methods:{
        getImage(url){
            return `/storage/${url}`;
        },
        fetchStudent:function(){
            axios.get('/api/student').then((response)=>{
                this.students = response.data.data;
            });
        },
        deleteStudent:function(student){
            axios.delete('/api/student/'+student).then((response)=>{
                let i = this.students.map(data=>data.id).indexOf(student);
                this.students.splice(i,1);
            });
        }
    }
}
</script>