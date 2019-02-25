package com.geekdev.primoveisbeta;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class Cadastro_usuario extends AppCompatActivity {

    EditText txt_nome, txt_email, txt_telefone, txt_senha, txt_csenha, txt_cpf;
    String url = "";
    String parametros = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_cadastro_usuario);

        txt_nome = (EditText)findViewById(R.id.txt_nome_cadastro);
        txt_email = (EditText)findViewById(R.id.txt_email_cadastro);
        txt_telefone = (EditText)findViewById(R.id.txt_telefone_cadastro);
        txt_senha = (EditText)findViewById(R.id.txt_senha_cadastro);
        txt_csenha = (EditText)findViewById(R.id.txt_senhac_cadastro);
        txt_cpf = (EditText)findViewById(R.id.txt_cpf_cadastro);
    }

    public void ClicarCadastro(View v){

        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();


        if (networkInfo != null && networkInfo.isConnected()) {

            String nome = txt_nome.getText().toString();
            String email = txt_email.getText().toString();
            String telefone = txt_telefone.getText().toString();
            String senha = txt_senha.getText().toString();
            String csenha = txt_csenha.getText().toString();
            String cpf = txt_cpf.getText().toString();

            if (nome.isEmpty() || email.isEmpty() || telefone.isEmpty() || senha.isEmpty() || csenha.isEmpty() || cpf.isEmpty()){
                Toast.makeText(getApplicationContext(), "Nenhum campo pode estar vazio", Toast.LENGTH_LONG).show();
            }
            else if(senha.equals(csenha)){
                url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/cadastro.php";
                parametros = "nome=" + nome + "&email=" + email + "&telefone=" + telefone + "&senha=" + csenha + "&cpf=" + cpf;
                new SolicitaDados().execute(url);
            }
            else{
                Toast.makeText(getApplicationContext(), "As senhas não conferem", Toast.LENGTH_LONG).show();
            }
        }
        else {
            Toast.makeText(getApplicationContext(), "Nenhuma conexão encontrada", Toast.LENGTH_LONG).show();
        }
    }
    private class SolicitaDados extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        @Override
        protected void onPostExecute(String resultado){
            if(resultado.contains("cadastro_ok")){
                Toast.makeText(getApplicationContext(), "Cadastrado com sucesso. Efetue o login.", Toast.LENGTH_LONG).show();
                finish();
                overridePendingTransition(0, android.R.anim.slide_out_right);
            } else if (resultado.contains("cpf_erro")){
                Toast.makeText(getApplicationContext(), "CPF já cadastrado", Toast.LENGTH_LONG).show();
            } else if (resultado.contains("email_existe")){
                Toast.makeText(getApplicationContext(), "Email já cadastrado", Toast.LENGTH_LONG).show();
            } else if (resultado.contains("email_erro")){
                Toast.makeText(getApplicationContext(), "Digite um email válido", Toast.LENGTH_LONG).show();
            } else if(resultado.contains("senha_erro")) {
                Toast.makeText(getApplicationContext(), "Senha precisar conter no mínimo 7 e no máximo 10 caracteres", Toast.LENGTH_LONG).show();
            } else if (resultado.contains("telefone_erro")){
                Toast.makeText(getApplicationContext(), "O telefone precisa conter no mínimo 11 caracteres (com DD)", Toast.LENGTH_LONG).show();
            } else if (resultado.contains("cpf_invalido")){
                Toast.makeText(getApplicationContext(), "Digite um CPF válido", Toast.LENGTH_LONG).show();
            } else if (resultado.contains("cpf_dif_onze")){
                Toast.makeText(getApplicationContext(), "O cpf precisa conter 11 caracteres", Toast.LENGTH_LONG).show();
            } else if (resultado.contains("cpf_erro")){
                Toast.makeText(getApplicationContext(), "CPF erro", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(getApplicationContext(), "Erro no cadastro", Toast.LENGTH_LONG).show();
            }
        }
    }
}
