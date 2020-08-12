
<script>
/**
 * Vue JS component to input of Brazil documents CPF and CNPJ
 * With built in 
 * @validation with vuelidate - that can be given to parent component to validate 
 * @mask with vue-the-mask
 * 
 */


import { required } from 'vuelidate/lib/validators'

export const validCPF = (value, component) => {
  //Função para validar CPF
  var cpf = value;
  if (value.length < 11) return false;
  var Soma;
  var Resto;
  Soma = 0;
  if (cpf == "00000000000") return false;

  for (var i = 1; i <= 9; i++)
    Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
  Resto = (Soma * 10) % 11;

  if (Resto == 10 || Resto == 11) Resto = 0;
  if (Resto != parseInt(cpf.substring(9, 10))) return false;

  Soma = 0;
  for (i = 1; i <= 10; i++)
    Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
  Resto = (Soma * 10) % 11;

  if (Resto == 10 || Resto == 11) Resto = 0;
  if (Resto != parseInt(cpf.substring(10, 11))) return false;
  return true;
}

export const validCNPJ = (value, component) => {
  //Função para validar CNPJ
  var cnpj = value;

  if (cnpj == "") return false;

  if (cnpj.length != 14) return false;

  // Elimina CNPJs invalidos conhecidos
  if (
    cnpj == "00000000000000" ||
    cnpj == "11111111111111" ||
    cnpj == "22222222222222" ||
    cnpj == "33333333333333" ||
    cnpj == "44444444444444" ||
    cnpj == "55555555555555" ||
    cnpj == "66666666666666" ||
    cnpj == "77777777777777" ||
    cnpj == "88888888888888" ||
    cnpj == "99999999999999"
  )
    return false;

  // Valida DVs
  var tamanho = cnpj.length - 2;
  var numeros = cnpj.substring(0, tamanho);
  var digitos = cnpj.substring(tamanho);
  var soma = 0;
  var pos = tamanho - 7;
  for (var i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) pos = 9;
  }
  var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(0)) return false;

  tamanho = tamanho + 1;
  numeros = cnpj.substring(0, tamanho);
  soma = 0;
  pos = tamanho - 7;
  for (var i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--;
    if (pos < 2) pos = 9;
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
  if (resultado != digitos.charAt(1)) return false;

  return true;
    //Função para validar CPF
}

export default {
  props: {
    'classes' : {
        default: () => { return ['form-control', 'input']; }
    }, 
    //Attribute to choose between CPF and CNPJ
    'kind':{
      default: 'cpf'
    }, 
    'placeholder': {}, 
    'name': '',
    'required' : {
      default: () =>{ return true;}
    },
    'masked' : {
      default: () => { return false;}
    },
    //Used to synk v-model param on parent component to value input here
    'value' : {
      default: () => { return ''; }
    }
  },
  data(){
    return  {
      valid : true
    };
  },
  computed : {
      mask : function () {
        //Defines the maks given the parent component 'kind' param
        if (this.kind == "cpf") {
            return ["###.###.###-##"];
        }
        if (this.kind == "cnpj") {
            return  ["##.###.###/####-##"];
        }
        return ["###.###.###-##"];
      },
      validation : function() {
        return this.$v;
      }
  },
  validations() {
    if (this.kind == 'cpf') {
      return {
        value : {
          required,
          validCPF
        }
      }
    } else if (this.kind == 'cnpj') {
      return {
        value : {
          required,
          validCNPJ
        }
      }
    }
  },
  methods: {
    emitValidation() {
      //Emits 'validate' event to parent component handle
      this.valid = this.validate();
      this.$emit("validate", this.valid);
    },
    validate() {
      //Method to validade, can be used by parent component using vue js $refs
      if (this.value.length > 0) {
        //Função para validar CPF
        if (this.kind == "cpf") {
          var cpf = this.value;
          if (this.value.length < 11) return false;
          var Soma;
          var Resto;
          Soma = 0;
          if (cpf == "00000000000") return false;

          for (i = 1; i <= 9; i++)
            Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
          Resto = (Soma * 10) % 11;

          if (Resto == 10 || Resto == 11) Resto = 0;
          if (Resto != parseInt(cpf.substring(9, 10))) return false;

          Soma = 0;
          for (i = 1; i <= 10; i++)
            Soma = Soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
          Resto = (Soma * 10) % 11;

          if (Resto == 10 || Resto == 11) Resto = 0;
          if (Resto != parseInt(cpf.substring(10, 11))) return false;
          return true;
        } //Função para validar CPF
        //Função para validar CNPJ
        if (this.kind == "cnpj") {
          var cnpj = this.value;

          if (cnpj == "") return false;

          if (cnpj.length != 14) return false;

          // Elimina CNPJs invalidos conhecidos
          if (
            cnpj == "00000000000000" ||
            cnpj == "11111111111111" ||
            cnpj == "22222222222222" ||
            cnpj == "33333333333333" ||
            cnpj == "44444444444444" ||
            cnpj == "55555555555555" ||
            cnpj == "66666666666666" ||
            cnpj == "77777777777777" ||
            cnpj == "88888888888888" ||
            cnpj == "99999999999999"
          )
            return false;

          // Valida DVs
          var tamanho = cnpj.length - 2;
          var numeros = cnpj.substring(0, tamanho);
          var digitos = cnpj.substring(tamanho);
          var soma = 0;
          var pos = tamanho - 7;
          for (i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
          }
          var resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(0)) return false;

          tamanho = tamanho + 1;
          numeros = cnpj.substring(0, tamanho);
          soma = 0;
          pos = tamanho - 7;
          for (var i = tamanho; i >= 1; i--) {
            soma += numeros.charAt(tamanho - i) * pos--;
            if (pos < 2) pos = 9;
          }
          resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
          if (resultado != digitos.charAt(1)) return false;

          return true;
        } //Função para validar CPF
      } else return false; //if length == 0;
    }
    //@blur.native="emitValidation()"
  }
};
</script>
<template>
<div :class="{'has-error' : $v.$invalid && $v.$dirty, 'has-danger' : $v.$invalid && $v.$dirty}">
    <the-mask
        type="text"
        :name="name"
        :class="classes"
        :mask="mask"
        :masked="masked"
        :placeholder="placeholder"
        :value="value"
         @input="$emit('input', $event)"
         @blur.native="$v.$touch()"
    />
    <div v-show="$v.$invalid && $v.$dirty" class="help-block with-errors">{{ kind == 'cpf' ? 'CPF inválido.' : 'CNPJ inválido.'}}</div>
</div>
</template>