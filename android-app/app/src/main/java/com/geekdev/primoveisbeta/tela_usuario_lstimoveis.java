package com.geekdev.primoveisbeta;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.net.ConnectivityManager;
import android.net.NetworkInfo;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.View;
import android.widget.Adapter;
import android.widget.AdapterView;
import android.widget.Toast;
import android.view.View.OnClickListener;

import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;

import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;

public class tela_usuario_lstimoveis extends AppCompatActivity {

    private RecyclerView lvhape;

    private RequestQueue requestQueue;
    private StringRequest stringRequest;

    String parametros = "";
    String url = "";
    String idUsuario;
    String tipoClick;
    String tipoimovel;
    String negoimovel;
    String cddimovel;

    ArrayList<HashMap<String, String>> list_data;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tela_usuario_lstimoveis);

        idUsuario = getIntent().getExtras().getString("id_usuario");
        String idusuario = idUsuario;

        tipoClick = getIntent().getExtras().getString("tipo_click");
        String click = tipoClick;

        tipoimovel = getIntent().getExtras().getString("tipo_imovel");
        String tipoimv = tipoimovel;

        negoimovel = getIntent().getExtras().getString("nego_imovel");
        String negoimv = negoimovel;

        cddimovel = getIntent().getExtras().getString("cidade_imovel");
        String cddimv = cddimovel;

        //Toast.makeText(getApplicationContext(), click, Toast.LENGTH_LONG).show();


        //String url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/listarimo.php?id_usuario=" + idusuario;

        if (click.contains("1")) {
            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/listarimo.php?id_usuario=" + idusuario;
            this.setTitle("PR-Imoveisbeta - Imóveis");
        } else if (click.contains("2")){
            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/listafav.php?id_usuario=" + idusuario;
            this.setTitle("PR-Imoveisbeta - Favoritos");
        } else if (click.contains("3")){
            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/listares.php?id_usuario=" + idusuario;
            this.setTitle("PR-Imoveisbeta - Reservados");
        } else {
            url = "https://www.ctbarmc-imobiliariabeta.com.br/assets/phpbd/android/filtrar.php?id_usuario=" + idusuario + "&cidade_imovel=" + cddimv + "&tipo_imovel=" + tipoimv + "&nego_imovel=" + negoimv;
            //Toast.makeText(getApplicationContext(), url, Toast.LENGTH_LONG).show();
            this.setTitle("PR-Imoveisbeta - Filtrar");
        }

        lvhape = (RecyclerView) findViewById(R.id.lvhape);
        LinearLayoutManager llm = new LinearLayoutManager(this);
        llm.setOrientation(LinearLayoutManager.VERTICAL);
        lvhape.setLayoutManager(llm);

        requestQueue = Volley.newRequestQueue(tela_usuario_lstimoveis.this);

        list_data = new ArrayList<HashMap<String, String>>();

        stringRequest = new StringRequest(Request.Method.GET, url, new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Log.d("response ", response);
                try {
                    JSONObject jsonObject = new JSONObject(response);
                    JSONArray jsonArray = jsonObject.getJSONArray("Imoveis");
                    for (int a = 0; a < jsonArray.length(); a++) {
                        JSONObject json = jsonArray.getJSONObject(a);
                        HashMap<String, String> map = new HashMap<String, String>();
                        map.put("id", json.getString("id"));
                        map.put("titulo", json.getString("titulo"));
                        map.put("nomeimg", json.getString("nomeimg"));
                        map.put("valor", json.getString("valor"));
                        map.put("descricao", json.getString("descricao"));
                        map.put("rua", json.getString("rua"));
                        map.put("nrua", json.getString("nrua"));
                        map.put("id_usuario", json.getString("id_usuario"));
                        map.put("cidade", json.getString("cidade"));
                        map.put("bairro", json.getString("bairro"));
                        list_data.add(map);
                        AdapterList adapter = new AdapterList(tela_usuario_lstimoveis.this, list_data);
                        lvhape.setAdapter(adapter);
                    }
                } catch (JSONException e) {
                    e.printStackTrace();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(tela_usuario_lstimoveis.this, error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        requestQueue.add(stringRequest);
    }
}
