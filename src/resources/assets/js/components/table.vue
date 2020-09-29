<template>
  <table class="table table-bordered">
    <tr>
      <th>ID</th>
      <th>{{ trans("bank.bank_name") }}</th>
      <th>{{ trans("bank.bank_code") }}</th>
      <th v-if="country.iso === 'BR'">{{ trans("bank.agency_caracteres_length") }}</th>
      <th v-if="country.iso === 'BR'">{{ trans("bank.agency_digit_required") }}</th>
      <th v-if="country.iso === 'BR'">{{ trans("bank.agency_digit_length") }}</th>
      <th v-if="country.iso === 'BR'">{{ trans("bank.account_caracteres_length") }}</th>
      <th v-if="country.iso === 'BR'">{{ trans("bank.account_digit_required") }}</th>
      <th v-if="country.iso === 'BR'">{{ trans("bank.account_digit_length") }}</th>
      <th>{{ trans("bank.action_grid") }}</th>
    </tr>
    <tr v-for="value in gridData.data" :key="value.id">
      <td>{{ value.id }}</td>
      <td>{{ value.name }}</td>
      <td>{{ value.code }}</td>

      <td v-if="country.iso === 'BR'">{{ value.agency_max_length }}</td>
      <td v-if="country.iso === 'BR'" class="centered">
        <span
          v-if="value.agency_digit_required"
          class="label label-success label-rouded"
        >{{ trans("bank.yes") }}</span>
        <span v-else class="label label-danger label-rouded">{{ trans("bank.no") }}</span>
      </td>
      <td v-if="country.iso === 'BR'">{{ value.agency_digit_max_length }}</td>
      <td v-if="country.iso === 'BR'">{{ value.account_max_length }}</td>
      <td v-if="country.iso === 'BR'" class="centered">
        <span
          v-if="value.account_digit_required"
          class="label label-success label-rouded">
            {{ trans("bank.yes") }}
        </span>
        <span v-else class="label label-danger label-rouded">{{ trans("bank.no") }}</span>
      </td>
      <td v-if="country.iso === 'BR'">{{ value.account_digit_max_length }}</td>
      <td>
        <div class="dropdown">
          <button
            class="btn btn-info dropdown-toggle"
            type="button"
            id="dropdownMenu1"
            data-toggle="dropdown">
              {{ trans("bank.action_grid") }}
            <span class="caret"></span>
          </button>

          <div
            class="dropdown-menu dropdown-menu-right"
            role="menu"
            aria-labelledby="dropdownMenu1">
            <a
              class="dropdown-item"
              id="follow"
              tabindex="-1"
              :href="updateRoute + '/' + value.id">
                {{ trans("bank.edit") }}
            </a>
            <a
              class="dropdown-item"
              id="detail"
              tabindex="-1"
              @click="deleteBank(value)">
                {{ trans("bank.remove") }}
            </a>
          </div>
        </div>
      </td>
    </tr>
  </table>
</template>

<script>
import axios from "axios";
export default {
  props: ["gridData", "country", "updateRoute", "deleteRoute"],
  name: "BankTable",

  async mounted() { },

  methods: {
    deleteBank(value) {
      this.$emit('delete-bank', value);
    }
  }
};
</script>

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
