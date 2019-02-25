package com.geekdev.primoveisbeta;

import android.app.Activity;
import android.content.Context;
import android.graphics.Color;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;
import android.widget.Button;

import com.bumptech.glide.Glide;

public class tela_usuario_lstimoveisplus extends AppCompatActivity {

    TextView txt_id, txt_titulo, txt_valor, txt_descricao, txt_rua, txt_nrua, txt_cidade, txt_bairro;
    ImageView nomeimgg;
    //Button favBtn, resBtn;
    String idImovel, tituloImovel, valorImovel, idUsuario, descricaoImovel, ruaImovel, nruaImovel, nomeImg, cidade, bairro;
    String url = "";
    String parametros = "";
    String dados[];
    Context context;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela_usuario_lstimoveisplus);

        this.context = getApplicationContext();

        idImovel = getIntent().getExtras().getString("id_imovel");
        idUsuario = getIntent().getExtras().getString("id_usuario");
        tituloImovel = getIntent().getExtras().getString("titulo_imovel");
        valorImovel = getIntent().getExtras().getString("valor");
        descricaoImovel = getIntent().getExtras().getString("descricao");
        ruaImovel = getIntent().getExtras().getString("rua");
        nruaImovel = getIntent().getExtras().getString("nrua");
        nomeImg = getIntent().getExtras().getString("nomeimg");
        cidade = getIntent().getExtras().getString("cidade");
        bairro = getIntent().getExtras().getString("bairro");

        this.setTitle("PR-Imoveisbeta - Imóvel ID " + idImovel);

        /*txt_id = (TextView) findViewById(R.id.txt_id_plus);
        txt_id.setText(idImovel);*/

        txt_titulo = (TextView) findViewById(R.id.txt_titulo_plus);
        txt_titulo.setText(tituloImovel);

        txt_valor = (TextView) findViewById(R.id.txt_valor_plus);
        txt_valor.setText(valorImovel);

        txt_cidade = (TextView) findViewById(R.id.txt_cidadeplus);
        txt_cidade.setText(cidade);

        txt_bairro = (TextView) findViewById(R.id.txt_bairroplus);
        txt_bairro.setText(bairro);

        txt_descricao = (TextView) findViewById(R.id.txt_descricao_plus);
        txt_descricao.setText(descricaoImovel);

        txt_rua = (TextView) findViewById(R.id.txt_rua_plus);
        txt_rua.setText(ruaImovel);

        txt_nrua = (TextView) findViewById(R.id.txt_nrua_plus);
        txt_nrua.setText(nruaImovel);

        txt_nrua = (TextView) findViewById(R.id.txt_nrua_plus);
        txt_nrua.setText(nruaImovel);

        nomeimgg = (ImageView) findViewById(R.id.nomeimgg);

        //Toast.makeText(getApplicationContext(), nomeImg, Toast.LENGTH_LONG).show();

        Glide.with(context)
                .load("https://www.ctbarmc-imobiliariabeta.com.br/assets/img/fotosimoveis/" + nomeImg)
                .crossFade()
                .placeholder(R.mipmap.ic_launcher)
                .into(nomeimgg);

        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        if (networkInfo != null && networkInfo.isConnected()) {
            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/verificaresfav.php";
            parametros = "id_imovel=" + idImovel + "&id_usuario=" + idUsuario;
            new SolicitaDados().execute(url);
        } else {
            Toast.makeText(getApplicationContext(), "Nenhuma conexão encontrada", Toast.LENGTH_LONG).show();
        }
    }

    /* Verificar dados */

    private class SolicitaDados extends AsyncTask<String, Void, String> {

        @Override
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }

        @Override
        protected void onPostExecute(String resultado) {

            dados = resultado.split(",");

            if (dados[0].contains("imovel_jafav")) {
                Button favBtn = (Button) findViewById(R.id.btn_favoritarimovellstplus);
                favBtn.setText("Remover dos favoritos");
                favBtn.setTextColor(Color.WHITE);
            }
            if(dados[1].contains("imovel_jares")) {
                Button favBtn = (Button) findViewById(R.id.btn_reservarimovellstplus);
                favBtn.setText("Cancelar reserva");
                favBtn.setTextColor(Color.WHITE);
            }
        }
    }

    /* Adicionar o imóvel aos favoritos */
    public void favoritarImovel(View view) {
        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        if (networkInfo != null && networkInfo.isConnected()) {

            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/resfav.php";
            if(dados[0].contains("imovel_jafav")){
                parametros = "id_imovel=" + idImovel + "&id_usuario=" + idUsuario + "&tipo=fav&tipor=rem";
                new AddFav().execute(url);
            } else {
                parametros = "id_imovel=" + idImovel + "&id_usuario=" + idUsuario + "&tipo=fav&tipor=add";
                new AddFav().execute(url);
            }
        } else {
            Toast.makeText(getApplicationContext(), "Nenhuma conexão encontrada", Toast.LENGTH_LONG).show();
        }
    }

    private class AddFav extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }
        @Override
        protected void onPostExecute(String resultado) {
            if (resultado.contains("ok")){
                Toast.makeText(getApplicationContext(), "Imóvel adicionado aos favoritos", Toast.LENGTH_LONG).show();
                recreate();
            } else if (resultado.contains("removerfav")) {
                Toast.makeText(getApplicationContext(), "Imóvel removido dos favoritos", Toast.LENGTH_LONG).show();
                recreate();
            } else {
                Toast.makeText(getApplicationContext(), "Erro ao favoritar", Toast.LENGTH_LONG).show();
            }
        }
    } /* Fim adicionar o imóvel aos favoritos */

    /* Reservar imóvel */
    public void reservarImovel(View view) {
        ConnectivityManager connMgr = (ConnectivityManager)
                getSystemService(Context.CONNECTIVITY_SERVICE);
        NetworkInfo networkInfo = connMgr.getActiveNetworkInfo();

        if (networkInfo != null && networkInfo.isConnected()) {

            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/resfav.php";
            if(dados[1].contains("imovel_jares")){
                parametros = "id_imovel=" + idImovel + "&id_usuario=" + idUsuario + "&tipo=res&tipor=rem";
                new AddReserva().execute(url);
            } else {
                parametros = "id_imovel=" + idImovel + "&id_usuario=" + idUsuario + "&tipo=res&tipor=add";
                new AddReserva().execute(url);
            }
        } else {
            Toast.makeText(getApplicationContext(), "Nenhuma conexão encontrada", Toast.LENGTH_LONG).show();
        }
    }

    private class AddReserva extends AsyncTask<String, Void, String> {
        @Override
        protected String doInBackground(String... urls) {
            return Conexao.postDados(urls[0], parametros);
        }
        @Override
        protected void onPostExecute(String resultado) {
            if (resultado.contains("ok")){
                Toast.makeText(getApplicationContext(), "Imóvel reservado com sucesso", Toast.LENGTH_LONG).show();
                recreate();
            } else if (resultado.contains("removerres")){
                Toast.makeText(getApplicationContext(), "Reserva cancelada com sucesso", Toast.LENGTH_LONG).show();
                recreate();
            } else {
                Toast.makeText(getApplicationContext(), "Erro ao reservar", Toast.LENGTH_SHORT).show();
            }
        }
    } /* Fim reservar imóvel */
}
