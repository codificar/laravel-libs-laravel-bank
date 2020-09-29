<template>
	<div>
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">{{ trans("bank.filter") }}</h4>
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
												<label for="giveName">ID :</label>
												<input
													v-model="filter.id"
													type="number"
													class="form-control"
													placeholder="id"
													maxlength="10"
												/>
											</div>
										</div>
										<div class="col-md-2">
											<div class="form-group">
												<label for="giveName">{{ trans("bank.bank_code") }}</label>
												<input
													v-model="filter.code"
													:type="filter.country_iso === 'AO' ? 'text' : 'number'"
													class="form-control"
													v-bind:placeholder="trans('bank.bank_code')"
													maxlength="10"
												/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="giveName">{{ trans("bank.bank_name") }}</label>
												<input
													v-model="filter.name"
													type="text"
													class="form-control"
													v-bind:placeholder="trans('bank.bank_name')"
													maxlength="255"
												/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">{{ trans("bank.country") }}</label>
												<select
													v-model="filter.country_iso"
													name="type_entry"
													class="select form-control"
												>
													<option value="0">{{trans('bank.country') }}</option>
													<option
														v-for="option in countries"
														v-bind:value="option.iso"
														v-bind:key="option.iso"
													>{{option.name}}</option>
												</select>
											</div>
										</div>
									</div>
									<!--/ END ROW 1 -->
									<div v-if="filter.country_iso === 'BR'">
										<!--/ ROW 2-->
										<div class="row">
											<div class="col-md-4">
												<div class="form-group">
													<label for="giveName">{{ trans("bank.agency_caracteres_length") }}</label>
													<input
														v-model="filter.agency_max_length"
														type="number"
														class="form-control"
														v-bind:placeholder="trans('bank.agency_caracteres_length')"
														maxlength="10"
													/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">{{ trans("bank.agency_digit_required") }}</label>
													<select
														name="IsWork"
														v-model="filter.agency_digit_required"
														class="select form-control"
													>
														<option :value="null">{{ trans("bank.agency_digit_required") }}</option>
														<option value="1">{{ trans("bank.yes") }}</option>
														<option value="0">{{ trans("bank.no") }}</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="giveName">{{ trans("bank.agency_digit_length") }}</label>
													<input
														v-model="filter.agency_digit_max_length"
														type="number"
														class="form-control"
														v-bind:placeholder="trans('bank.agency_digit_length')"
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
													<label for="giveName">{{ trans("bank.account_caracteres_length") }}</label>
													<input
														v-model="filter.account_max_length"
														type="number"
														class="form-control"
														v-bind:placeholder="trans('bank.account_caracteres_length')"
														maxlength="10"
													/>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label class="control-label">{{ trans("bank.account_digit_required") }}</label>
													<select
														name="IsWork"
														v-model="filter.account_digit_required"
														class="select form-control"
													>
														<option :value="null">{{ trans("bank.account_digit_required") }}</option>
														<option value="0">{{ trans("bank.no") }}</option>
														<option value="1">{{ trans("bank.yes") }}</option>
													</select>
												</div>
											</div>
											<div class="col-md-4">
												<div class="form-group">
													<label for="giveName">{{ trans("bank.account_digit_length") }}</label>
													<input
														v-model="filter.account_digit_max_length"
														type="number"
														class="form-control"
														v-bind:placeholder="trans('bank.account_digit_length')"
														maxlength="10"
													/>
												</div>
											</div>
										</div>
										<!--/ END ROW 3-->
									</div>
									<div class="box-footer pull-left">
										<button
											@click="cleanFilters"
											class="btn btn-danger right"
											type="button"
											value="clean"
										>
											<i class="fa fa-trash"></i>
											{{this.trans("bank.clear_filters") }}
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
											{{ trans("bank.search") }}
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
						<a :href="this.createRoute" class="btn pull-left hidden-sm-down btn-success">
							<i class="mdi mdi-plus-circle"></i>
							{{ trans("bank.add_bank") }}
						</a>
					</h3>
				</div>
				<div class="card-block">

					<BankTable
						:country="getCountry()"
						:grid-data="gridData"
					    :update-route="updateRoute"
        				@delete-bank="deleteBank">
					</BankTable>

					<pagination :data="gridData" @pagination-change-page="changePage"></pagination>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import axios from "axios";
import BankTable from "../table";
export default {
	props: [
		"indexRoute",
		"filterRoute",
		"createRoute",
		"countriesRoute",
		"updateRoute",
		"deleteRoute",
	],
	name: "CodificarBankPanel",
	components: {
    	BankTable
  	},
	async mounted() {
		await this.getCountriesList();
		await this.getBankList();
	},
	data() {
		return {
			currentPage: 1,
			itemsperPage: 15,
			gridData: {},
			countries: [],
			filter: {
				id: null,
				name: null,
				code: null,
				country_iso: null,

				agency_max_length: null,
				agency_digit_required: null,
				agency_digit_max_length: null,

				account_max_length: null,
				account_digit_required: null,
				account_digit_max_length: null,
			},
		};
	},
	methods: {
		async deleteBank(bank) {
			this.$swal({
				title: "Remover Banco",
				text: "Tem certeza que deseja remover o banco: " + bank.name + " ?",
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
					console.log("Error Delete Bank", error);
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
				agency_digit_required: null,
				agency_digit_max_length: null,
				account_max_length: null,
				account_digit_required: null,
				account_digit_max_length: null,
				country_iso: null,
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
				const result = await axios.get(this.filterRoute, {
					params: {
						...this.filter,
						page: this.currentPage,
						itemsperpage: this.itemsperPage,
					}
				});

				this.gridData = result.data;
			} catch (error) {
				console.log("Error indexRoute", error);
			}
		},
		async getCountriesList() {
			try {
				const result = await axios.get(this.countriesRoute);
				this.countries = result.data;
			} catch (error) {
				console.log("Error countriesRoute", error);
			}
		},
		async getBankList() {
			try {
				const result = await axios.get(this.indexRoute, 
					{ params: {itemsperpage: this.itemsperPage}}
				);
				this.gridData = result.data;
			} catch (error) {
				console.log("Error indexRoute", error);
			}
		},
		async changePage(page = 1) {
			try {
				this.currentPage = page;
				const response = await axios.get(this.indexRoute, 
					{params: {
						page: this.currentPage,
						itemsperpage: this.itemsperPage
					}}
				);
				this.gridData = response.data;
			} catch (error) {
				console.log("Error changePage", error);
			}
			this.$nextTick();
		},
		getCountry () {
			if(this.gridData.data){
				const bank = this.gridData.data.find(bank => bank!== undefined);
				if(bank)
					return this.countries.find(c => c.id === bank.country_id);
			}
			return {};
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
