<template>
	<div>
		<div class="col-lg-12">
			<div class="card card-outline-info">
				<div class="card-header">
					<h4 class="m-b-0 text-white">{{this.trans("bank.add_bank") }}</h4>
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
										<div class="col-md-4">
											<div class="form-group">
												<label for="giveName">{{this.trans("bank.bank_code") }}</label>
												<input
													v-model="form.code"
													type="number"
													class="form-control"
													v-bind:placeholder= "trans('bank.bank_code')"
													maxlength="5"
												/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="giveName">{{this.trans("bank.bank_name") }}</label>
												<input
													v-model="form.name"
													type="text"
													class="form-control"
													v-bind:placeholder="trans('bank.bank_name')"
													maxlength="255"
												/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="giveName">{{this.trans("bank.country") }}</label>
												<select
													v-model="form.country_id"
													name="type_entry"
													class="select form-control"
												>
													<option value="0">{{trans('bank.country') }}</option>
													<option
														v-for="option in countries"
														v-bind:value="option.id"
														v-bind:key="option.id"
													>{{option.name}}</option>
												</select>
											</div>
										</div>
									</div>
									<!--/ END ROW 1 -->
									<!--/ ROW 2-->
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label for="giveName">{{this.trans('bank.agency_caracteres_length')}}</label>
												<input
													v-model="form.agency_max_length"
													type="number"
													class="form-control"
													placeholder="Caracteres Agência"
													maxlength="10"
												/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">{{this.trans('bank.agency_digit_required')}}</label>
												<select
													name="IsWork"
													v-model="form.agency_digit_required"
													class="select form-control"
												>
													<option value="0">{{ trans("bank.no") }}</option>
													<option value="1">{{ trans("bank.yes") }}</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="giveName">{{this.trans('bank.agency_digit_length')}}</label>
												<input
													v-model="form.agency_digit_max_length"
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
													v-model="form.account_max_length"
													type="number"
													class="form-control"
													v-bind:placeholder="trans('bank.account_caracteres_length')"
													maxlength="10"
												/>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label class="control-label">{{this.trans('bank.account_digit_required')}}</label>
												<select
													name="IsWork"
													v-model="form.account_digit_required"
													class="select form-control"
												>
													<option value="1">{{ trans("bank.yes") }}</option>
													<option value="0">{{ trans("bank.no") }}</option>
												</select>
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label for="giveName">{{this.trans('bank.account_digit_length')}}</label>
												<input
													v-model="form.account_digit_max_length"
													type="number"
													class="form-control"
													v-bind:placeholder="trans('bank.account_digit_length')"
													maxlength="10"
												/>
											</div>
										</div>
									</div>
									<!--/ END ROW 3-->
									<div class="box-footer pull-right m-2">
										<button
											v-if="this.isEdit"
											@click="edit"
											class="btn btn-warning right p-3"
											type="button"
											value="Filter_Data"
										>
											<i class="mdi mdi-pencil"></i>
											{{ trans("bank.save") }}
										</button>
										<button
											v-else
											@click="create"
											class="btn btn-success right p-3"
											type="button"
											value="Filter_Data"
										>
											<i class="mdi mdi-plus-circle"></i>
											{{ this.trans("bank.add") }}
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
	</div>
</template>
<script>
import axios from "axios";

// import the component
import CodificarBankPanel from "../components/CodificarBankPanel";
export default {
	props: [
		"indexRoute",
		"countriesRoute",
		"storeRoute",
		"panelRoute",
		"isEdit",
		"dataId",
		"showRoute",
		"updateRoute",
	],
	components: {
		CodificarBankPanel,
	},
	data() {
		return {
			countries: [],
			form: {
				name: null,
				code: null,
				agency_max_length: 4,
				agency_digit_required: 0,
				agency_digit_max_length: 1,

				account_max_length: 11,
				account_digit_required: 1,
				account_digit_max_length: 1,
			},
		};
	},
	async mounted() {
		await this.getCountriesList();
		if (this.isEdit) {
			const data = await this.show(this.dataId);
			this.form.name = data.name;
			this.form.country_id = data.country_id;
			this.form.code = data.code;
			this.form.agency_max_length = data.agency_max_length;
			this.form.agency_digit_required = data.agency_digit_required;
			this.form.agency_digit_max_length = data.agency_digit_max_length;
			this.form.account_max_length = data.account_max_length;
			this.form.account_digit_required = data.account_digit_required;
			this.form.account_digit_max_length = data.account_digit_max_length;
		}
	},
	methods: {
		async create() {
			try {
				const result = await axios.post(this.storeRoute, this.form);
				if (result.data.sucess) {
					this.$swal({
						title: "Banco cadastrado com sucesso",
						html:
							'<label class="alert alert-success alert-dismissable text-left"> Banco ' +
							result.data.value.name +
							" Cadastrado</label>",
						type: "success",
					});
					window.location.href = this.panelRoute;
					return true;
				} else {
					this.$swal({
						title: "Preencha os campos corretamente",
						html:
							'<label class="alert alert-warning alert-dismissable text-left">' +
							result.data.errors.join(", ") +
							"</label>",
						type: "warning",
					});
				}
			} catch (error) {
				console.log("Store Error", error);
			}
		},
		async edit() {

			console.log('edit method')
			try {
				this.form.id = this.dataId;
				const result = await axios.put(
					this.updateRoute + "/" + this.dataId,
					this.form
				);
				if (result.data.sucess) {
					this.$swal({
						title: "Banco atualizado com sucesso",
						html:
							'<label class="alert alert-success alert-dismissable text-left"> Banco ' +
							result.data.value.name +
							" Cadastrado</label>",
						type: "success",
					});
					window.location.href = this.panelRoute;
					return true;
				} else {
					this.$swal({
						title: "Preencha os campos corretamente",
						html:
							'<label class="alert alert-warning alert-dismissable text-left">' +
							result.data.errors.join(", ") +
							"</label>",
						type: "warning",
					});
				}
			} catch (error) {
				console.log("Store Error", error);
			}
		},
		async show(id) {
			try {
				const result = await axios.get(`${this.showRoute}/${id}`);
				return result.data;
			} catch (error) {
				console.log("Error Show API", error);
			}
		},
		async getCountriesList() {
			console.log(this.countriesRoute);
			try {
				const result = await axios.get(this.countriesRoute);
				this.countries = result.data;
			} catch (error) {
				console.log("Error countriesRoute", error);
			}
		},
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
/* .vue-treeselect_multi-value-item-container {
	display: none;
} */
</style>
