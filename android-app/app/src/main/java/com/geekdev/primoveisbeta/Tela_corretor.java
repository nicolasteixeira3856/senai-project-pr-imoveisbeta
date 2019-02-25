package com.geekdev.primoveisbeta;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.TextView;

public class Tela_corretor extends AppCompatActivity {

    TextView txtNome;
    String idUsuario, nomeUsuario;


    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela_corretor);

        this.setTitle("PR-Imoveisbeta - Painel do Corretor");

        nomeUsuario = getIntent().getExtras().getString("nome_usuario");
        txtNome = (TextView)findViewById(R.id.nomecorretor);
        txtNome.setText(nomeUsuario);

        idUsuario = getIntent().getExtras().getString("id_usuario");
    }

    public void deslogar_corretor(View view) {
        finish();
        overridePendingTransition(0, android.R.anim.slide_out_right);
    }

    public void ReservarImovelCliente(View view) {
        Intent intent = new Intent(getApplicationContext(), tela_corretor_reserimovelcliente.class);
        startActivity(intent);
    }

    public void editarperfilcorretor(View view) {
        Intent EditarPerfil = new Intent(this, activity_tela_corretor_editarperfil.class);
        EditarPerfil.putExtra("id_usuario", idUsuario);
        startActivity(EditarPerfil);
    }
}
