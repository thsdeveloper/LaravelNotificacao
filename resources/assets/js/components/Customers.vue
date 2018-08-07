<template>
  <div class="customers">
    <v-data-table :headers="headers" :items="clientes" hide-actions class="elevation-1">
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td class="text-xs-right">{{ props.item.cpf }}</td>
        <td class="text-xs-right">{{ props.item.telefone }}</td>
      </template>
    </v-data-table>

    <!--Modal de Cadastro de novos integrantes-->
    <v-dialog v-model="dialog" width="800px">
      <v-card>
        <v-card-title class="grey lighten-4 py-4 title">
          Adicionar novo integrante
        </v-card-title>
        <v-container grid-list-sm class="pa-4">
          <v-layout row wrap>

            <v-form ref="form" v-model="valid" lazy-validation>
              <v-flex xs12 align-center justify-space-between>
                <v-layout align-center>
                  <v-text-field v-model="ruleForm.name" :rules="nameRules" :counter="10" label="Nome do integrante" required></v-text-field>
                </v-layout>
              </v-flex>
              <v-flex xs12 align-center justify-space-between>
                <v-layout align-center>
                  <v-text-field v-model="ruleForm.cpf" :counter="11" label="CPF" required></v-text-field>
                </v-layout>
              </v-flex>
              <v-flex xs12 align-center justify-space-between>
                <v-layout align-center>
                  <v-text-field v-model="ruleForm.telefone"  placeholder="(61) 9 9999-9999" v-mask="'(##) ##### ####'" :counter="11" label="CPF" required></v-text-field>
                </v-layout>
              </v-flex>
            </v-form>

          </v-layout>
        </v-container>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="clear">Cancelar</v-btn>
          <v-btn flat  :disabled="!valid" @click="submit">Adicionar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>

    <!--Botão para cadastrar novo integrante-->
    <v-btn fab bottom right color="purple" dark fixed @click.stop="dialog = !dialog">
      <v-icon>add</v-icon>
    </v-btn>



  </div>
</template>

<script>
    export default {
        data() {
            return {
                valid: true,
                clientes: [],
                dialog: false,
                ruleForm: {
                    name: '',
                    cpf: '',
                    telefone: '',
                },
                nameRules: [
                    v => !!v || 'Nome obrigatório',
                    v => v.length <= 10 || 'O nome deve ter menos de 10 caracteres'
                ],

                headers: [
                    { text: 'Nome', value: 'name' },
                    { text: 'CPF', value: 'cpf' },
                    { text: 'Telefone', value: 'telefone' },
                ],

            };
        },
        methods: {
            submit () {
                if (this.$refs.form.validate()) {
                    axios.post('/cadastrar/cliente', {
                        name: this.ruleForm.name,
                        cpf: this.ruleForm.cpf,
                        telefone: this.ruleForm.telefone,
                    }).then(function (response) {
                        window.location.href = "/home";
                        console.log(response);
                    }).catch(function (error) {
                        console.log(error);
                    });
                }
            },
            clear() {
                this.$refs.form.reset()
            },
            handleEdit(index, row) {
                this.dialogVisible = true;
                this.ruleForm.name = row.name;
                this.ruleForm.cpf = row.cpf;
                this.ruleForm.telefone = row.telefone;
                console.log(index, row);
            },
            handleDelete(index, row) {
                var _this = this;
                _this.$confirm('Deletar este cliente?', 'Deletar', {
                    confirmButtonText: 'OK',
                    cancelButtonText: 'Cancel',
                    type: 'warning'
                }).then(() => {
                    _this.loading = true;
                    axios.post('/cadastrar/excluir', {
                        id: row.id,
                    })
                        .then(function (response) {
                            _this.loading = false;
                            _this.clientes.splice(index, 1);
                            _this.$message({
                                type: 'success',
                                message: 'Escluído com sucesso!'
                            });
                        })
                        .catch(function (error) {
                            console.log(error);
                        });
                }).catch(() => {
                });
            }
        },
        mounted() {
            var _this = this;
            axios.get('/clientes').then(function (r) {
                _this.clientes = r.data;
            }).catch(function (error) {
                console.log(error);
            });

        }
    };
</script>
<style>

</style>
