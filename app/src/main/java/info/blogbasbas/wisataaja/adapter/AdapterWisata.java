package info.blogbasbas.wisataaja.adapter;

import android.content.Context;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.TextView;

import com.squareup.picasso.Picasso;

import java.util.ArrayList;
import java.util.List;

import info.blogbasbas.wisataaja.Constant;
import info.blogbasbas.wisataaja.R;
import info.blogbasbas.wisataaja.model.WisataItem;
import timber.log.Timber;

/**
 * Created by User on 25/03/2018.
 */

public class AdapterWisata extends
        RecyclerView.Adapter<AdapterWisata.MyHolder>

{
    private ClickListener clickListener;
    private List<WisataItem> dataset;
    //interface linstiner klik

    public interface ClickListener {
        void onClick (int position);
    }
    //counstructor
    public AdapterWisata(ClickListener clickListener){
        this.clickListener = clickListener;
        this.dataset = new ArrayList<WisataItem>();
    }
    public void setWisata (List<WisataItem> wisataItems){
        dataset = wisataItems;
        notifyDataSetChanged();
    }
    public WisataItem getWisatalItem(int position){
        return dataset.get(position);
    }

    @Override
    public AdapterWisata.MyHolder onCreateViewHolder(ViewGroup parent, int viewType) {
        View view = LayoutInflater.from(parent.getContext())
                .inflate(R.layout.item_list, parent, false);
        return new MyHolder(view, clickListener);
    }

    @Override
    public void onBindViewHolder(AdapterWisata.MyHolder holder,final int position) {
        final WisataItem wisataItem = dataset.get(position);
        holder.tvNama.setText(wisataItem.getNamaWisata());
        holder.tvKet.setText(wisataItem.getAlamatWisata());
        //load gambar
        Picasso.get().load(Constant.IMG_URL
                +wisataItem.getGambarWisata())
                .placeholder(R.mipmap.ic_launcher)
                .error(R.mipmap.ic_launcher)
                .into(holder.imgWIsata);
        holder.itemView.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Timber.e("KLIK :" +wisataItem.getIdWisata());
                clickListener.onClick(position);
            }
        });

    }

    @Override
    public int getItemCount() {
        return dataset.size();
    }


    public class MyHolder extends RecyclerView.ViewHolder {
       ImageView imgWIsata;
       TextView tvNama, tvKet;

        public MyHolder(View itemView, ClickListener clickListener) {
            super(itemView);
            imgWIsata = (ImageView)itemView.findViewById(R.id.imgWisata);
            tvNama = (TextView)itemView.findViewById(R.id.tvNamaWisata);
            tvKet = (TextView)itemView.findViewById(R.id.tvKet);

        }
    }
}
