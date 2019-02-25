package com.geekdev.primoveisbeta;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.EditText;
import android.widget.Toast;

public class tela_usuario_filtrarimovel extends AppCompatActivity {

    EditText txt_tipo, txt_nego, txt_cidade;
    String idUsuario;
    String tipoClick;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela_usuario_filtrarimovel);

        this.setTitle("PR-Imoveisbeta - Filtrando imóveis");

        idUsuario = getIntent().getExtras().getString("id_usuario");
        tipoClick = getIntent().getExtras().getString("tipo_click");

        txt_tipo = (EditText)findViewById(R.id.tipoimovel);
        txt_nego = (EditText)findViewById(R.id.tiponego);
        txt_cidade = (EditText)findViewById(R.id.cidade);

    }

    public void buscar(View view) {

        String tipo = txt_tipo.getText().toString();
        String nego = txt_nego.getText().toString();
        String cidade = txt_cidade.getText().toString();

        Intent AbreLista = new Intent(tela_usuario_filtrarimovel.this, tela_usuario_lstimoveis.class);
        AbreLista.putExtra("id_usuario", idUsuario);
        AbreLista.putExtra("tipo_click", tipoClick);
        AbreLista.putExtra("tipo_imovel", tipo);
        AbreLista.putExtra("nego_imovel", nego);
        AbreLista.putExtra("cidade_imovel", cidade);
        startActivity(AbreLista);
    }
}
