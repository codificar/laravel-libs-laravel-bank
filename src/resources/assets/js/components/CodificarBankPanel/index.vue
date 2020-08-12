<template>
  <div>
    <div class="col-lg-12">
      <div class="card card-outline-info">
        <div class="card-header">
          <h4 class="m-b-0 text-white">{{ trans("dashboard.filter") }}</h4>
        </div>
        <div class="card-block">
          <div class="row">
            <div class="col-md-12">
              <div class="box box-warning">
                <div class="box-header">
                  <h3 class="box-title"></h3>
                </div>
                <!--/ START FILTER -->
                <div class="box-body">
                  <!--/ ROW 1 -->
                  <div class="row">
                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="giveName"> ID :</label>
                        <input
                          v-model="filter.id"
                          type="number"
                          class="form-control"
                          placeholder="id"
                          maxlength="10"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="giveName"> Nome do Banco:</label>
                        <input
                          v-model="filter.name"
                          type="text"
                          class="form-control"
                          placeholder="Nome do Banco"
                          maxlength="255"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="giveName"> Código do Banco :</label>
                        <input
                          v-model="filter.code"
                          type="number"
                          class="form-control"
                          placeholder="Código do Banco"
                          maxlength="3"
                        />
                      </div>
                    </div>
                  </div>
                  <!--/ END ROW 1 -->
                  <!--/ ROW 2-->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="giveName"> Caracteres Agência :</label>
                        <input
                          v-model="filter.agency_max_length"
                          type="number"
                          class="form-control"
                          placeholder="Caracteres Agência"
                          maxlength="10"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label"
                          >Digito da Agência obrigatorio</label
                        >
                        <select
                          name="IsWork"
                          v-model="filter.agency__digit_required"
                          class="select form-control"
                        >
                          <option :value="null"
                            >Digito da Agência obrigatorio</option
                          >
                          <option value="1">Sim</option>
                          <option value="0">Não</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="giveName">
                          Caracteres Digito da Agência :</label
                        >
                        <input
                          v-model="filter.agency__digit_max_length"
                          type="number"
                          class="form-control"
                          placeholder="Caracteres Digito da Agência"
                          maxlength="10"
                        />
                      </div>
                    </div>
                  </div>
                  <!--/ END ROW 2-->
                  <!--/ ROW 3-->
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="giveName"> Caracteres da Conta :</label>
                        <input
                          v-model="filter.account_max_length"
                          type="number"
                          class="form-control"
                          placeholder="Caracteres da Conta"
                          maxlength="10"
                        />
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label"
                          >Digito Conta obrigatorio</label
                        >
                        <select
                          name="IsWork"
                          v-model="filter.account__digit_required"
                          class="select form-control"
                        >
                          <option :value="null"
                            >Digito Conta obrigatorio</option
                          >
                          <option value="1">Sim</option>
                          <option value="0">Não</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="giveName">
                          Caracteres da Digito Conta :</label
                        >
                        <input
                          v-model="filter.account_digit_max_length"
                          type="number"
                          class="form-control"
                          placeholder="Caracteres da Digito Conta"
                          maxlength="10"
                        />
                      </div>
                    </div>
                  </div>
                  <!--/ END ROW 3-->
                  <div class="box-footer pull-left">
                    <button
                      @click="cleanFilters"
                      class="btn btn-danger right"
                      type="button"
                      value="clean"
                    >
                      <i class="fa fa-trash"></i> Limpar Filtros
                    </button>
                  </div>

                  <div class="box-footer pull-right">
                    <!-- <button @click="downLoadReport" class="btn btn-info right" type="button">
                        <i class="mdi mdi-download"></i> {{trans('dashboard.down_report')}}</button>-->
                    <button
                      @click="filterBankList"
                      class="btn btn-success right"
                      type="button"
                      value="Filter_Data"
                    >
                      <i class="fa fa-search"></i>
                      {{ trans("dashboard.search") }}
                    </button>
                  </div>
                </div>
                <!--/ END FILTER -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-12">
      <div class="card">
        <div class="card-block">
          <h3 class="card-title">
            <a
              :href="this.createRoute"
              class="btn pull-left hidden-sm-down btn-success"
            >
              <i class="mdi mdi-plus-circle"></i> Adicionar Banco
            </a>
          </h3>
        </div>
        <div class="card-block">
          <table class="table table-bordered">
            <tr>
              <th>ID</th>
              <th>Nome</th>
              <th>Código</th>
              <th>Caracteres Agência</th>
              <th>Digito da Agência obrigatorio</th>
              <th>Caracteres Digito da Agência</th>

              <th>Caracteres da Conta</th>
              <th>Digito Conta obrigatorio</th>
              <th>Caracteres da Digito Conta</th>
              <th>Ação</th>
            </tr>
            <tr v-for="value in gridData.data" :key="value.id">
              <td>{{ value.id }}</td>
              <td>{{ value.name }}</td>
              <td>{{ value.code }}</td>
              <td>{{ value.agency_max_length }}</td>
              <td class="centered">
                <span
                  v-if="value.agency__digit_required"
                  class="label label-success label-rouded"
                  >Sim</span
                >
                <span v-else class="label label-danger label-rouded">Não</span>
              </td>
              <td>{{ value.agency__digit_max_length }}</td>
              <td>{{ value.account_max_length }}</td>
              <td class="centered">
                <span
                  v-if="value.account__digit_required"
                  class="label label-success label-rouded"
                  >Sim</span
                >
                <span v-else class="label label-danger label-rouded">Não</span>
              </td>
              <td>{{ value.account_digit_max_length }}</td>
              <td>
                <div class="dropdown">
                  <button
                    class="btn btn-info dropdown-toggle"
                    type="button"
                    id="dropdownMenu1"
                    data-toggle="dropdown"
                  >
                    {{ trans("provider.action_grid") }}
                    <span class="caret"></span>
                  </button>

                  <div
                    class="dropdown-menu dropdown-menu-right"
                    role="menu"
                    aria-labelledby="dropdownMenu1"
                  >
                    <a
                      class="dropdown-item"
                      id="follow"
                      tabindex="-1"
                      :href="updateRoute + '/' + value.id"
                      >Editar</a
                    >
                    <a
                      class="dropdown-item"
                      id="detail"
                      tabindex="-1"
                      @click="deleteBank(value)"
                      >Deletar</a
                    >
                  </div>
                </div>
              </td>
            </tr>
          </table>

          <pagination
            :data="gridData"
            @pagination-change-page="changePage"
          ></pagination>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
export default {
  props: [
    "indexRoute",
    "filterRoute",
    "createRoute",
    "updateRoute",
    "deleteRoute",
  ],
  name: "CodificarBankPanel",
  async mounted() {
    await this.getBankList();
  },
  data() {
    return {
      currentPage: 1,
      gridData: {},
      filter: {
        id: null,
        name: null,
        code: null,

        agency_max_length: null,
        agency__digit_required: null,
        agency__digit_max_length: null,

        account_max_length: null,
        account__digit_required: null,
        account_digit_max_length: null,
      },
    };
  },
  methods: {
    async deleteBank(bank) {
      this.$swal({
        title: "Remover Banco",
        text: "Tem certeza que deseja remover o banco: "+ bank.name+" ?",
        type: "warning",
        showCancelButton: true,
        cancelButtonText: "Não",
        confirmButtonText: "Sim",
      }).then(async (result) => {
        if (result.value) {
           try {
        const result = await axios.delete(this.deleteRoute + "/" + bank.id);
        this.getBankList();
      } catch (error) {
        console.log("Error Delte Bank", error);
      }
        }
      });


    },
    async cleanFilters() {
      this.filter = {
        id: null,
        name: null,
        code: null,
        agency_max_length: null,
        agency__digit_required: null,
        agency__digit_max_length: null,
        account_max_length: null,
        account__digit_required: null,
        account_digit_max_length: null,
      };
      try {
        const result = await axios.get(this.indexRoute);
        this.gridData = result.data;
      } catch (error) {
        console.log("Error indexRoute", error);
      }
    },
    async filterBankList() {
      try {
        const result = await axios.post(this.filterRoute, {
          id: this.filter.id,
          name: this.filter.name,
          code: this.filter.code,
          agency_max_length: this.filter.agency_max_length,
          agency__digit_required: this.filter.agency__digit_required,
          agency__digit_max_length: this.filter.agency__digit_max_length,
          account_max_length: this.filter.account_max_length,
          account__digit_required: this.filter.account__digit_required,
          account_digit_max_length: this.filter.account_digit_max_length,
          page: this.currentPage,
          itemsperpage: 20,
        });
        console.log(result);

        this.gridData = result.data;
      } catch (error) {
        console.log("Error indexRoute", error);
      }
    },
    async getBankList() {
      console.log(this.indexRoute);
      try {
        const result = await axios.get(this.indexRoute);
        this.gridData = result.data;
      } catch (error) {
        console.log("Error indexRoute", error);
      }
    },
    async changePage(page = 1) {
      try {
        this.currentPage = page;
        const response = await axios.get(
          `${this.indexRoute}?page=${this.currentPage}`
        );
        this.gridData = response.data;
      } catch (error) {
        console.log("Error changePage", error);
      }
      this.$nextTick();
    },
  },
};
</script>
>

<style>
#bank-header {
  background-color: rgba(0, 0, 0, 0.5);
}

.centered {
  text-align: center;
  vertical-align: middle;
}

span {
  width: 80%;
}
</style>
