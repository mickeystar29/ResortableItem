<template>
    <div>
        <div class="col-12">
            <div class="row">
                <a href="/tasks/create" class="btn btn-info mr-5"> + Add Task</a>
                <select v-model="projectId" @change="changeProject" name="project" id="" class="form-control col-md-3">
                    <option value="0" selected>All</option>
                    <option v-for="project in this.projects" :value=project.id>{{ project.title }}</option>
                </select>
            </div>
        </div>
        <div class="col-6">
            <ul id="sort-1" class="list-group mt-5">
                <li v-for="(task, index) in taskItems" :id="task.id" class="list-group-item d-flex justify-content-between">
                    <div>
                        <a class="handle">=</a>
                        <strong class="ml-3">{{ task.title }}</strong>
                    </div>
                    <div>
                        <a :href="`/tasks/${task.id}/edit`" class="btn btn-info">Edit</a>
                        <button  class="btn btn-danger" @click="deleteTask(task.id, index)">X</button>
                    </div>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
export default {
    props: ['tasks', 'projects'],
    data() {
            return {
                projectId: 0,
                taskItems: this.tasks
            }
        },
        methods: {
            changeProject() {
                const self = this
                $.ajax({
                    method: 'GET',
                    url: '/project/'+this.projectId+'/tasks',
                    success:function(response)
                    {
                        console.log(response);
                        self.taskItems = response.tasks
                    },
                    error: function(response) {
                        console.log(response);
                    }
                })
            },
            deleteTask(id, index) {
                const self = this
                $.ajax({
                        method: 'DELETE',
                        url: '/tasks/'+id,
                        data: {_token: $('meta[name="csrf-token"]').attr('content')},
                        success:function(response)
                        {
                            console.log(response);
                            self.taskItems.splice(index, 1)
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    })
            }
        },
        computed: {

        },
        mounted() {
            $( "#sort-1" ).sortable({
                containment: 'parent',
                handle: '.handle',
                update: function(event, ui) {
                    $.ajax({
                        method: 'POST',
                        url: '/tasks/resort',
                        data: {_token: $('meta[name="csrf-token"]').attr('content'), items: $(this).sortable('toArray').toString() },
                        success:function(response)
                        {
                            console.log(response);
                        },
                        error: function(response) {
                            console.log(response);
                        }
                    })
                }
           });
        }
    }
</script>
