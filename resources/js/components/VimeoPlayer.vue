<template>
  <div>
    <div v-if="lesson" :data-vimeo-id="lesson.video_id" data-vimeo-width="600" id="handstick"></div>
  </div>
</template>
<script>
import Player from "@vimeo/player";
import Swal from "sweetalert2";
export default {
  props: ["default_lesson", 'next_lesson_url'],
  data() {
    return {
      lesson: JSON.parse(this.default_lesson),
      next_lesson: this.next_lesson_url,
    };
  },
  methods: {
    // alertVideoPlayed() {
    //     Swal.fire("Good job!", "You clicked the button!", "success")
    //   .then(() =>{
    //       window.location = this.next_lesson_url;
    //   });
    // }
  },
  mounted() {
    var handstickPlayer = new Player("handstick");
    handstickPlayer.on("ended", () => {
         if(this.next_lesson_url){
              Swal.fire("Good job!", "You have completed the Lesson!", "success")
      .then(() =>{
          window.location = this.next_lesson;
      });
         }else{
              Swal.fire("Good job!", "You have completed the series!", "success")
         }
    });
  },

};
</script>
