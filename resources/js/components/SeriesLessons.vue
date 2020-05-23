<template>
  <div>
    <div class="row justify-content-center mb-2">
      <button @click="createNewLesson()" class="btn btn-success btn-lg">Create New Lesson</button>
      <create-lessons></create-lessons>
    </div>
    <div class="card text-white bg-success">
      <div class="card-body">
        <h2 class="card-title">Lessons</h2>
      </div>
      <ul class="list-group text-dark list-group-flush">
        <li class="list-group-item" v-for="lesson in lessons" :key="lesson.id">
          {{lesson.title}}
          <button class="btn btn-primary" @click="edit(lesson)">Edit</button>
          <button class="btn btn-danger" @click="destroy(lesson)">Delete</button>
        </li>
      </ul>
    </div>
  </div>
</template>
<script>
import Swal from "sweetalert2";
export default {
  props: ["default_lessons", "series_id"],
  components: {
    "create-lessons": require("./children/CreateLessons.vue").default
  },
  data() {
    return {
      lessons: JSON.parse(this.default_lessons),
    };
  },
  mounted() {
    this.$on("lesson_created", lesson => {
      this.lessons.splice(0, 0, lesson);
    });
    this.$on("lesson_updated", lesson => {
        // let lessonIndex = this.lessons.findIndex( l => {
        //     return lesson.id == l.id;
        // });
        this.lessons.splice(this.lessons.indexOf(lesson) , 1 , lesson);
    });
  },

  methods: {
    createNewLesson() {
      this.$emit("create_new_lesson", this.series_id);
    },

    edit(lesson){
        let series_id = this.series_id;
      this.$emit('edit_lesson' , { series_id , lesson});
    },
    destroy(lesson) {
      axios
        .delete("/admin/series/" + this.series_id + "/lessons/" + lesson.id)
        .then(res => {
          this.lessons.splice(this.lessons.indexOf(lesson), 1);
          Swal.fire({
            position: "top-end",
            icon: "success",
            title: "You have successfully Deleted",
            showConfirmButton: false,
            timer: 800
          });
        })
        .catch(err => {
          console.error(err);
          Swal.fire({
            position: "top-end",
            icon: "error",
            title: "Something went wrong. Please Try Again!",
            showConfirmButton: false,
            timer: 800
          });
        });
    }
  }
};
</script>
