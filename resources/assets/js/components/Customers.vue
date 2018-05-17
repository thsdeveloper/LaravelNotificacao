<template>
  <div class="customers">
    <div class="row justify-content-center">
      <div class="col-md-12">
        <div class="card card-default">
          <div class="card-header">Clientes
            <el-button type="success" size="mini" icon="el-icon-circle-plus" class="btn-new-cliente" @click="dialogVisible = true">Novo cliente</el-button>
          </div>

          <div class="card-body">
            I'm an example component.
          </div>
        </div>
      </div>
    </div>



    <el-dialog title="Cadastrar novo cliente" :visible.sync="dialogVisible" width="50%" :before-close="handleClose">
      <el-form :model="ruleForm" :rules="rules" ref="ruleForm" class="demo-ruleForm">
        <el-form-item prop="name">
          <el-input v-model="ruleForm.name" v-mask="'##/##/####'" placeholder="Nome do cliente"></el-input>
        </el-form-item>
        <el-form-item prop="cpf">
          <the-mask v-model="ruleForm.cpf" :mask="['###.###.###-##']" placeholder="Número do CPF"/>
        </el-form-item>
        <el-form-item prop="telefone">
          <the-mask v-model="ruleForm.telefone" :mask="['(##) ####-####', '(##) #####-####']" placeholder="Telefone"/>
        </el-form-item>
        <el-form-item class="mold-butons">
          <el-button type="primary" @click="submitForm('ruleForm')">Criar</el-button>
          <el-button @click="resetForm('ruleForm')">Limpar</el-button>
        </el-form-item>
      </el-form>

    </el-dialog>
  </div>
</template>

<script>
export default {
  data() {
    return {
      ruleForm: {
        name: '',
        cpf: '',
        telefone: '',
      },
      rules: {
        name: [
          { required: true, message: 'Digite um nome para o cliente', trigger: 'blur' },
        ],
        cpf: [
          { required: true, message: 'Digite um cpf', trigger: 'blur' },
        ],
        telefone: [
          { required: true, message: 'Digite um telefone', trigger: 'blur' },
        ]
      },

      dialogVisible: false
    };
  },
  methods: {
    handleClose(done) {
      this.$confirm('Deseja cancelar o processo de cadastro?')
      .then(_ => {
        done();
      })
      .catch(_ => {});
    },
    submitForm(formName) {
      this.$refs[formName].validate((valid) => {
        if (valid) {
          alert('submit!');
        } else {
          console.log('error submit!!');
          return false;
        }
      });
    },
    resetForm(formName) {
      this.$refs[formName].resetFields();
    }
  }
};
</script>

<style>
button.el-button.btn-new-cliente.el-button--success.el-button--mini {
  float: right;
}
.el-form-item.mold-butons {
    margin-top: 35px;
}
</style>
