<template>
       <CodificarBankPanel
        :index-route="indexRoute"
        :filter-route="filterRoute"
        :create-route="createRoute"
        :update-route="updateRoute"
        :delete-route="deleteRoute"
       >

      </CodificarBankPanel>
</template>
<script>
import axios from "axios";

// import the component
import CodificarBankPanel from "../components/CodificarBankPanel/";
export default {
  props: ["indexRoute", "filterRoute", "createRoute", "updateRoute", "deleteRoute"],
  components: {
     CodificarBankPanel
  },
  data() {
    return {
      bankList: "",
    };
  },
  async mounted() { 
  },
  methods: {
  },
};
</script>

<style>
#treeselect {
  padding: 20px;
}
#tree-content {
  padding-bottom: 40px;
}
/* .vue-treeselect__multi-value-item-container {
  display: none;
} */
</style>
