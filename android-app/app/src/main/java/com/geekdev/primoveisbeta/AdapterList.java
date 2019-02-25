package com.geekdev.primoveisbeta;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.AdapterView;
import android.widget.ImageView;
import android.widget.TextView;
import android.widget.Toast;

import com.bumptech.glide.Glide;
import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.HashMap;

/**
 * Created by Aluno on 23/03/2017.
 */

public class AdapterList extends RecyclerView.Adapter<AdapterList.ViewHolder> {
    Context context;
    ArrayList<HashMap<String, String>> list_data;

    public AdapterList(tela_usuario_lstimoveis mainActivity, ArrayList<HashMap<String, String>> list_data) {
        this.context = mainActivity;
        this.list_data = list_data;

    }

    @Override
    public ViewHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext()).inflate(R.layout.list_item, null);
        return new ViewHolder(view);
    }

    @Override
    public void onBindViewHolder(ViewHolder holder, int position) {
        Glide.with(context)
                .load("https://www.ctbarmc-imobiliariabeta.com.br/assets/img/fotosimoveis/" + list_data.get(position).get("nomeimg"))
                .crossFade()
                .placeholder(R.mipmap.ic_launcher)
                .into(holder.img_principal);
        holder.txtid.setText(list_data.get(position).get("id"));
        holder.txttitulo.setText(list_data.get(position).get("titulo"));
        holder.txtvalor.setText(list_data.get(position).get("valor"));
        holder.txtiduser.setText(list_data.get(position).get("id_usuario"));
        holder.txtdescricao.setText(list_data.get(position).get("descricao"));
        holder.txtrua.setText(list_data.get(position).get("rua"));
        holder.txtnrua.setText(list_data.get(position).get("nrua"));
        holder.nomeimg.setText(list_data.get(position).get("nomeimg"));
        holder.txtcidade.setText(list_data.get(position).get("cidade"));
        holder.txtbairro.setText(list_data.get(position).get("bairro"));
    }

    //txtiduser

    @Override
    public int getItemCount() {
        return list_data.size();
    }

    public class ViewHolder extends RecyclerView.ViewHolder {

        ImageView img_principal;
        TextView txtid;
        TextView txttitulo;
        TextView txtvalor;
        TextView txtiduser;
        TextView txtdescricao;
        TextView txtrua;
        TextView txtnrua;
        TextView nomeimg;
        TextView txtcidade;
        TextView txtbairro;

        public ViewHolder(View itemView) {
            super(itemView);

            img_principal = (ImageView) itemView.findViewById(R.id.imghp);
            txtid = (TextView) itemView.findViewById(R.id.txtid);
            txttitulo = (TextView) itemView.findViewById(R.id.txthape);
            txtvalor = (TextView) itemView.findViewById(R.id.txtvalor);
            txtdescricao = (TextView)itemView.findViewById(R.id.txtdescricao);
            txtrua = (TextView)itemView.findViewById(R.id.txtrua);
            txtnrua = (TextView)itemView.findViewById(R.id.txtnrua);
            txtiduser = (TextView)itemView.findViewById(R.id.txtiduser);
            nomeimg = (TextView)itemView.findViewById(R.id.nomeimg);
            txtcidade = (TextView)itemView.findViewById(R.id.txtcidade);
            txtbairro = (TextView)itemView.findViewById(R.id.txtbairro);

            itemView.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v){
                    /*Toast.makeText(context, "Posição: " + String.valueOf(getAdapterPosition()), Toast.LENGTH_LONG).show();*/
                    Context context = v.getContext();
                    Intent intent = new Intent(context, tela_usuario_lstimoveisplus.class);
                    intent.putExtra("posicao", String.valueOf(getAdapterPosition()));
                    intent.putExtra("id_imovel", txtid.getText());
                    intent.putExtra("titulo_imovel", txttitulo.getText());
                    intent.putExtra("valor", txtvalor.getText());
                    intent.putExtra("id_usuario", txtiduser.getText());
                    intent.putExtra("descricao", txtdescricao.getText());
                    intent.putExtra("rua", txtrua.getText());
                    intent.putExtra("nrua", txtnrua.getText());
                    intent.putExtra("nomeimg", nomeimg.getText());
                    intent.putExtra("cidade", txtcidade.getText());
                    intent.putExtra("bairro", txtbairro.getText());
                    context.startActivity(intent);
                }
            });
        }
    }
}
