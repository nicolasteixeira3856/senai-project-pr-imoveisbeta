package com.geekdev.primoveisbeta;

import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class tela_corretor_reserimovelcliente extends AppCompatActivity {

    EditText txt_email_cliente, txt_id_imovel_cliente;
    String url = "";
    String parametros = "";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela_corretor_reserimovelcliente);
        txt_email_cliente = (EditText) findViewById(R.id.txt_email_cliente);
        txt_id_imovel_cliente = (EditText) findViewById(R.id.txt_id_imovelcliente);

        this.setTitle("PR-Imoveisbeta - Reservando para cliente");
    }

    public void ClicarReservarImovelCliente(View view) {
        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        if (networkInfo != null && networkInfo.isConnected()) {

            String email = txt_email_cliente.getText().toString();
            String id = txt_id_imovel_cliente.getText().toString();

            if (email.isEmpty() || id.isEmpty()){
                Toast.makeText(getApplicationContext(), "Nenhum campo pode estar vazio", Toast.LENGTH_LONG).show();
            } else {
                url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/reservarcliente.php";
                parametros = "email=" + email + "&id_imovel=" + id;
                new SolicitaDados().execute(url);
            }
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
        protected void onPostExecute(String resultado){
            if(resultado.contains("imovel_reservado")) {
                Toast.makeText(getApplicationContext(), "Imóvel reservado com sucesso", Toast.LENGTH_LONG).show();
            } else if (resultado.contains("imovel_jareservado")){
                Toast.makeText(getApplicationContext(), "O cliente já reservou este imóvel", Toast.LENGTH_LONG).show();
            } else {
                Toast.makeText(getApplicationContext(), "Erro ao efetuar reserva", Toast.LENGTH_LONG).show();
            }
        }
    }
}
