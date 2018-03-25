package info.blogbasbas.wisataaja.ui;


import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.support.v4.app.Fragment;
import android.support.v7.widget.LinearLayoutManager;
import android.support.v7.widget.RecyclerView;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ImageView;
import android.widget.Toast;

import com.google.gson.Gson;

import org.greenrobot.greendao.query.Query;

import java.util.ArrayList;
import java.util.List;

import butterknife.BindView;
import butterknife.ButterKnife;
import butterknife.Unbinder;
import info.blogbasbas.wisataaja.BaseApp;
import info.blogbasbas.wisataaja.R;
import info.blogbasbas.wisataaja.adapter.AdapterWisata;
import info.blogbasbas.wisataaja.db.facade.Facade;
import info.blogbasbas.wisataaja.db.facade.ManageWisataTbl;
import info.blogbasbas.wisataaja.model.DaoSession;
import info.blogbasbas.wisataaja.model.WisataItem;
import info.blogbasbas.wisataaja.model.WisataItemDao;

/**
 * A simple {@link Fragment} subclass.
 */
public class HomeFragment extends Fragment {
    // inisialisasi greendao
    DaoSession daoSession;
    //query untuk get data dari tbl wistaItem
    WisataItemDao wisataItemDao;
    //untuk Query
    private Query<WisataItem> wisataItemQuery;

    AdapterWisata adapterWisata;

    RecyclerView recyclerView;
    List<WisataItem> itemList;
    List<WisataItem> wisataItems;
    ManageWisataTbl manageWisataTbl;

    ProgressDialog mProgressDialog;


    @BindView(R.id.rvListWIsata)
    RecyclerView rvListWIsata;
    Unbinder unbinder;

    public HomeFragment() {
        // Required empty public constructor
    }


    @Override
    public View onCreateView(LayoutInflater inflater, ViewGroup container,
                             Bundle savedInstanceState) {
        // Inflate the layout for this fragment
        View view = inflater.inflate(R.layout.fragment_home,
                container, false);
        unbinder = ButterKnife.bind(this, view);
        manageWisataTbl = Facade.getInstance().getManageWisataTbl();
        wisataItems = new ArrayList<>();


        daoSession = BaseApp.getDaoSession();
        wisataItemDao  = daoSession.getWisataItemDao();

        itemList = new ArrayList<>();



        mProgressDialog = new ProgressDialog(getActivity());
        mProgressDialog.setProgressStyle(ProgressDialog.STYLE_SPINNER);
        mProgressDialog.setTitle("Loading Data");
        mProgressDialog.setMessage("Please wait....");
        mProgressDialog.show();

        setUpView();
        wisataItemQuery = wisataItemDao.queryBuilder()
                .orderAsc
                (WisataItemDao.Properties.IdWisata)
                .build();
        updateView();


        return view;
    }

    private void updateView() {

        List<WisataItem> wisataItems = wisataItemQuery.list();
        adapterWisata.setWisata(wisataItems);
    }

    private void setUpView() {
        adapterWisata = new AdapterWisata(clickListener);
        rvListWIsata.setLayoutManager
                (new LinearLayoutManager(getActivity()));
        rvListWIsata.setHasFixedSize(true);
        rvListWIsata.setAdapter(adapterWisata);
        mProgressDialog.dismiss();


    }

    AdapterWisata.ClickListener clickListener =
            new AdapterWisata.ClickListener() {
                @Override
                public void onClick(int position) {

                    WisataItem wisataItem =
                            adapterWisata.getWisatalItem(position);
                    String wisataItemNama = wisataItem.getNamaWisata();
                    Toast.makeText(getActivity(), "Memilih : "+wisataItemNama, Toast.LENGTH_SHORT).show();
                    Intent kirimData = new Intent(getActivity(),DetailActivity.class);
                    kirimData.putExtra(DetailActivity.PARAMETERTBL, new Gson().toJson(wisataItem));
                    startActivity(kirimData);

                }
            };

    @Override
    public void onDestroyView() {
        super.onDestroyView();
        unbinder.unbind();
    }
}
