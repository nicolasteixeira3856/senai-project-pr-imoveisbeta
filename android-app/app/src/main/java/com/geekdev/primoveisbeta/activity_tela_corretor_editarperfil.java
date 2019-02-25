package com.geekdev.primoveisbeta;

import android.content.Context;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class activity_tela_corretor_editarperfil extends AppCompatActivity {

    EditText txt_nome_edita, txt_email_edita, txt_cpf_edita, txt_telefone_edita, txt_celular_edita;
    String parametros = "";
    String url = "";
    String idUsuario;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela_corretor_editarperfil);

        this.setTitle("PR-Imoveisbeta - Editando perfil");

        txt_nome_edita = (EditText) findViewById(R.id.txt_nome_editarusercorretor);
        txt_email_edita = (EditText) findViewById(R.id.txt_email_editarusercorretor);
        txt_cpf_edita = (EditText) findViewById(R.id.txt_cpf_editarusercorretor);
        txt_telefone_edita = (EditText) findViewById(R.id.txt_telefone_editarperfilcorretor);
        txt_celular_edita = (EditText) findViewById(R.id.txt_celular_editarperfilcorretor);

        idUsuario = getIntent().getExtras().getString("id_usuario");
        String idusuario = idUsuario;

        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        if (networkInfo != null && networkInfo.isConnected()) {
            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/perfil.php";
            parametros = "id_usuario=" + idusuario;
            new SolicitaDados().execute(url);
        } else {
            Toast.makeText(getApplicationContext(), "Nenhuma conexão encontrada", Toast.LENGTH_LONG).show();
        }
    }

    private class SolicitaDados extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        @Override
        protected void onPostExecute(String resultado) {

            String[] dados = resultado.split(",");

            txt_nome_edita.setText(dados[1]);
            txt_email_edita.setText(dados[2]);
            txt_cpf_edita.setText(dados[3]);
            txt_telefone_edita.setText(dados[4]);
            txt_celular_edita.setText(dados[5]);
        }
    }

    public void ClicarEditarPerfilcorretor(View view) {
        idUsuario = getIntent().getExtras().getString("id_usuario");
        String idusuario = idUsuario;

        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        if (networkInfo != null && networkInfo.isConnected()) {

            String nome = txt_nome_edita.getText().toString();
            String email = txt_email_edita.getText().toString();
            String telefone = txt_telefone_edita.getText().toString();
            String celular = txt_celular_edita.getText().toString();

            if (nome.isEmpty() || email.isEmpty() || telefone.isEmpty() || celular.isEmpty()) {
                Toast.makeText(getApplicationContext(), "Nenhum campo editável pode estar vazio", Toast.LENGTH_LONG).show();
            } else {
                url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/editarperfil.php";
                parametros = "id_usuario=" + idusuario + "&nome=" + nome + "&email=" + email + "&telefone=" + telefone + "&celular=" + celular;
                new EnviaDados().execute(url);
            }

        } else {
            Toast.makeText(getApplicationContext(), "Nenhuma conexão encontrada", Toast.LENGTH_LONG).show();
        }
    }
    private class EnviaDados extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        @Override
        protected void onPostExecute(String resultado) {
            if (resultado.contains("ok")) {
                Toast.makeText(getApplicationContext(), "Suas informações foram editadas com sucesso", Toast.LENGTH_LONG).show();
                finish();
                overridePendingTransition(0, android.R.anim.slide_out_right);
            } else  if (resultado.contains("telefone_erro")){
                Toast.makeText(getApplicationContext(), "O telefone precisa conter no mínimo 10 caracteres (com DD)", Toast.LENGTH_LONG).show();
            } else  if (resultado.contains("celular_erro")){
                Toast.makeText(getApplicationContext(), "O celular precisa conter no mínimo 10 caracteres (com DD)", Toast.LENGTH_LONG).show();
            } else  if (resultado.contains("email_erro")){
                Toast.makeText(getApplicationContext(), "Digite um email válido", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(getApplicationContext(), "Erro ao editar", Toast.LENGTH_LONG).show();
            }
        }
    }
}

