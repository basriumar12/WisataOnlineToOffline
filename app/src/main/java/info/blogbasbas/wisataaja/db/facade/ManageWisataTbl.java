package info.blogbasbas.wisataaja.db.facade;

import java.util.List;

import info.blogbasbas.wisataaja.model.WisataItem;
import info.blogbasbas.wisataaja.model.WisataItemDao;

/**
 * Created by User on 25/03/2018.
 */

public class ManageWisataTbl {

    Facade facade;
    WisataItemDao dao;

    public ManageWisataTbl(Facade facade) {
        this.dao= facade.session.getWisataItemDao();
        this.facade = facade;
    }
    public long add(WisataItem object) {
        return dao.insertOrReplace(object);
    }

    public void  add(List<WisataItem> object) {
        dao.insertOrReplaceInTx(object);
    }

    public List<WisataItem> getAll() {
        return dao.queryBuilder().list();
    }
    public WisataItem get(long id) {
        return dao.queryBuilder().where(WisataItemDao.Properties.IdWisata.eq(id)).unique();
    }
    public void removeAll() {
        dao.deleteAll();
    }

    public void remove(WisataItem object) {
        dao.delete(object);
    }

    public long size(){
        return dao.count();
    }
}
