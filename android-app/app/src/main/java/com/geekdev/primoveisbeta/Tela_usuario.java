package com.geekdev.primoveisbeta;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;
import android.widget.Toast;

import static com.geekdev.primoveisbeta.R.id.nomeuser;

public class Tela_usuario extends AppCompatActivity {

    TextView txtNome;
    String idUsuario, nomeUsuario;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela_usuario);

        this.setTitle("PR-Imoveisbeta - Painel do Usuário");

        nomeUsuario = getIntent().getExtras().getString("nome_usuario");
        txtNome = (TextView)findViewById(R.id.nomeuser);
        txtNome.setText(nomeUsuario);

        /* Aqui é onde as coisas começam a fazer um pouco de sentido */
        idUsuario = getIntent().getExtras().getString("id_usuario");
    }

    public void deslogar(View view) {
        finish();
        overridePendingTransition(0, android.R.anim.slide_out_right);
    }

    public void editarperfil(View view) {
        Intent EditarPerfil = new Intent(this, tela_usuario_editarperfil.class);
        EditarPerfil.putExtra("id_usuario", idUsuario);
        startActivity(EditarPerfil);
    }

    public void imoveisreservados(View view) {
        String tipoClick = "3";
        Intent ImoveisReservados = new Intent(this, tela_usuario_lstimoveis.class);
        ImoveisReservados.putExtra("id_usuario", idUsuario);
        ImoveisReservados.putExtra("tipo_click", tipoClick);
        startActivity(ImoveisReservados);
    }

    public void imoveisfavoritos(View view) {
        String tipoClick = "2";
        Intent ImoveisFavoritos = new Intent(this, tela_usuario_lstimoveis.class);
        ImoveisFavoritos.putExtra("id_usuario", idUsuario);
        ImoveisFavoritos.putExtra("tipo_click", tipoClick);
        startActivity(ImoveisFavoritos);
    }

    public void listaimoveis(View view) {
        String tipoClick = "1";
        Intent ListaImoveis = new Intent(this, tela_usuario_lstimoveis.class);
        ListaImoveis.putExtra("id_usuario", idUsuario);
        ListaImoveis.putExtra("tipo_click", tipoClick);
        startActivity(ListaImoveis);
    }

    public void filtrarimovel(View view) {
        String tipoClick = "4";
        Intent FiltrarImoveis = new Intent(this, tela_usuario_filtrarimovel.class);
        FiltrarImoveis.putExtra("id_usuario", idUsuario);
        FiltrarImoveis.putExtra("tipo_click", tipoClick);
        startActivity(FiltrarImoveis);
    }
}
