package com.geekdev.primoveisbeta;

import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.app.Activity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;




public class MainActivity extends Activity {

    EditText txt_email_login, txt_senha_login;
    String url = "";
    String parametros = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        txt_email_login = (EditText) findViewById(R.id.txt_email_login);
        txt_senha_login = (EditText) findViewById(R.id.txt_senha_login);

        this.setTitle("PR-Imoveisbeta - Login");
    }

    public void ClicarECadastro(View v) {
        Intent intent = new Intent(getApplicationContext(), Cadastro_usuario.class);
        startActivity(intent);
    }


    public void ClicarLogin(View v) {

        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        if (networkInfo != null && networkInfo.isConnected()) {

            String email = txt_email_login.getText().toString();
            String senha = txt_senha_login.getText().toString();

            if (email.isEmpty() || senha.isEmpty()) {
                Toast.makeText(getApplicationContext(), "Nenhum campo pode estar vazio", Toast.LENGTH_LONG).show();
            } else {
                url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/logar.php";
                parametros = "email=" + email + "&senha=" + senha;
                new SolicitaDados().execute(url);
        }
            }else{
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

            String[] dados = resultado.split(",");
            String nivel_usuario = dados[1];

            if(nivel_usuario.contains("3")){
                Intent AbreCliente = new Intent(MainActivity.this, Tela_usuario.class);
                AbreCliente.putExtra("id_usuario", dados[2]);
                AbreCliente.putExtra("nome_usuario", dados[3]);
                startActivity(AbreCliente);
            } else if (nivel_usuario.contains("2")){
                Intent AbreCorretor= new Intent(MainActivity.this, Tela_corretor.class);
                AbreCorretor.putExtra("id_usuario", dados[2]);
                AbreCorretor.putExtra("nome_usuario", dados[3]);
                startActivity(AbreCorretor);
            } else if (nivel_usuario.contains("1")){
                Toast.makeText(getApplicationContext(), "A conta de administrador só pode ser utilizada pelo site", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(getApplicationContext(), "Usuário ou senha incorretos", Toast.LENGTH_LONG).show();
            }
        }
    }
}
