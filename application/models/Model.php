<?php
class Model extends CI_Model
{
    var $klub = 'klub';
    var $pertandingan = 'pertandingan';

    function klasemen()
    {
        $this->db->select('klub.nm_klub AS klub');
        $this->db->select('COUNT(*) AS main');
        $this->db->select('SUM(CASE WHEN pertandingan.winner = 1 THEN 1 ELSE 0 END) AS menang');
        $this->db->select('SUM(CASE WHEN pertandingan.winner = 0 THEN 1 ELSE 0 END) AS seri');
        $this->db->select('SUM(CASE WHEN pertandingan.winner = 2 THEN 1 ELSE 0 END) AS kalah');
        $this->db->select('SUM(CASE WHEN klub.id = pertandingan.id THEN pertandingan.score1 ELSE pertandingan.score2 END) AS GM');
        $this->db->select('SUM(CASE WHEN klub.id = pertandingan.id THEN pertandingan.score2 ELSE pertandingan.score1 END) AS GK');
        $this->db->select('SUM(CASE WHEN pertandingan.winner = 1 THEN 3 WHEN pertandingan.winner = 0 THEN 1 ELSE 0 END) AS point');

        $this->db->from('klub');
        $this->db->join(
            '(SELECT klub1 AS id, score1, score2, 
                     CASE 
                         WHEN score1 > score2 THEN 1
                         WHEN score1 < score2 THEN 2
                         ELSE 0
                     END AS winner
              FROM pertandingan 
              UNION ALL 
              SELECT klub2 AS id, score2 AS score1, score1 AS score2,
                     CASE 
                         WHEN score2 > score1 THEN 1
                         WHEN score2 < score1 THEN 2
                         ELSE 0
                     END AS winner
              FROM pertandingan) AS pertandingan',
            'klub.id = pertandingan.id',
            'inner'
        );

        $this->db->group_by('klub.nm_klub');

        $query = $this->db->get();

        return $query->result();
    }

    function klub()
    {
        $this->db->select('*');
        $this->db->from('klub');
        $query = $this->db->get();

        return $query->result();
    }

    function input_klub($data)
    {
        $this->db->insert($this->klub, $data);
        return $this->db->insert_id();
    }

    function pertandingan()
    {
        $this->db->select('klub1.nm_klub AS klub1, klub2.nm_klub AS klub2, pertandingan.score1, pertandingan.score2');
        $this->db->from('pertandingan');
        $this->db->join('klub AS klub1', 'klub1.id = pertandingan.klub1');
        $this->db->join('klub AS klub2', 'klub2.id = pertandingan.klub2');

        $query = $this->db->get();

        return $query->result();
    }

    function input_pertandingan($data)
    {
        $this->db->insert($this->pertandingan, $data);
        return $this->db->insert_id();
    }

    public function get_match($klub1, $klub2)
    {
        $this->db->where('klub1', $klub1);
        $this->db->where('klub2', $klub2);
        $query = $this->db->get('pertandingan');

        return $query->row_array();
    }

    public function cek_match($klub1, $klub2)
    {
        $matches = array();

        foreach ($klub1 as $key => $value) {
            $match = $klub1[$key] . ' vs ' . $klub2[$key];
            if (in_array($match, $matches)) {
                return false;
            }
            $matches[] = $match;
        }

        return true;
    }
}
